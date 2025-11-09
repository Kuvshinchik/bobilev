<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Region;
use App\Models\Station;
use App\Models\ObjectCategory;
use App\Models\PreparationData;
use Carbon\Carbon;

class ImportExcelData extends Command
{
    protected $signature = 'import:excel {file}';
    protected $description = 'Импорт данных из Excel в БД';

    public function handle()
    {
        $filePath = $this->argument('file');
        
        if (!file_exists($filePath)) {
            $this->error('Файл не найден');
            return 1;
        }

        $this->info('Начало импорта...');
        
        $sheets = Excel::toArray([], $filePath)[0];
        
        foreach ($sheets as $sheetName => $rows) {
            if ($sheetName === '+ итог ДЖВ') continue;
            
            $this->processSheet($sheetName, $rows);
        }
        
        $this->info('Импорт завершён!');
        return 0;
    }
    
    protected function processSheet($regionName, $rows)
    {
        // Создаём регион
        $region = Region::firstOrCreate(['name' => $regionName]);
        
        // Извлекаем названия вокзалов из заголовков
        $stationNames = array_slice($rows[0], 8);
        
        $stations = [];
        foreach ($stationNames as $name) {
            if (empty(trim($name))) continue;
            
            $station = Station::firstOrCreate([
                'region_id' => $region->id,
                'name' => trim($name)
            ]);
            $stations[] = $station;
        }
        
        // Обрабатываем данные объектов
        for ($i = 1; $i < count($rows); $i++) {
            $row = $rows[$i];
            $objectName = $row[0] ?? '';
            $unit = $row[2] ?? '';
            
            if (empty(trim($objectName))) continue;
            
            $category = ObjectCategory::firstOrCreate([
                'name' => trim($objectName)
            ], [
                'unit' => $unit,
                'sort_order' => $i
            ]);
            
            // Импортируем данные для каждого вокзала
            foreach ($stations as $index => $station) {
                $value = $row[8 + $index] ?? '';
                
                if (empty($value)) continue;
                
                // Парсим "план/факт"
                $parts = explode('/', $value);
                $planValue = isset($parts[0]) ? intval($parts[0]) : 0;
                $factValue = isset($parts[1]) ? intval($parts[1]) : 0;
                
                PreparationData::updateOrCreate([
                    'station_id' => $station->id,
                    'object_category_id' => $category->id,
                    'report_date' => Carbon::parse('2025-11-01')
                ], [
                    'plan_value' => $planValue,
                    'fact_value' => $factValue
                ]);
            }
        }
    }
}
