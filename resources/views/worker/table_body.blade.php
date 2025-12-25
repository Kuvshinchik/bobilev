{{-- Частичный шаблон для AJAX-обновления таблицы --}}

<div data-total="{{ $workers->total() }}">
    <div class="table-responsive">
        <table class="table table-striped table-hover mb-0">
            <thead class="thead-dark">
                <tr>
                    <th>Табельный</th>
                    <th>Статус на сайте</th>
                    <th>Статус в ДЖВ</th>
                    <th>Вокзал</th>
                    <th>РДЖВ</th>
                    <th>ДЖВ</th>
                    <th class="text-center">Вакцинация</th>
                </tr>
            </thead>
            <tbody>
                @forelse($workers as $worker)
                <tr>
                    <td><strong>{{ $worker->tabelNumber }}</strong></td>
                    <td><span class="badge badge-soft-primary px-2 py-1">{{ $worker->statusSite }}</span></td>
                    <td><span class="badge badge-soft-info px-2 py-1">{{ $worker->statusVokzal }}</span></td>
                    <td>{{ $worker->vokzal ?? '—' }}</td>
                    <td>{{ $worker->rdzv ?? '—' }}</td>
                    <td>{{ $worker->dzv ?? '—' }}</td>
                    <td class="text-center">
                        @if($worker->vakcina)
                            <span class="badge badge-success"><i class="mdi mdi-check"></i> Да</span>
                        @else
                            <span class="badge badge-danger"><i class="mdi mdi-close"></i> Нет</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-muted py-4">
                        <i class="mdi mdi-account-search mdi-48px d-block mb-2"></i>
                        Работники не найдены
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($workers->hasPages())
    <div class="mt-4 d-flex justify-content-center">
        {{ $workers->links() }}
    </div>
    @endif
</div>
