/*
 Template Name: Annex - Bootstrap 4 Admin Dashboard
 Author: Mannatthemes
 Website: www.mannatthemes.com
 File: Morris init js (modified to draw bar chart for + итог ДЖВ)
 */

!function($) {
    "use strict";

    var Dashboard = function() {};

    //creates line chart
    Dashboard.prototype.createLineChart = function(element, data, xkey, ykeys, labels, lineColors) {
        Morris.Line({
          element: element,
          data: data,
          xkey: xkey,
          ykeys: ykeys,
          labels: labels,
          hideHover: 'auto',
          gridLineColor: '#eef0f2',
          resize: true, //defaulted to true
          lineColors: lineColors
        });
    },


    //creates area chart
    Dashboard.prototype.createAreaChart = function(element, pointSize, lineWidth, data, xkey, ykeys, labels, lineColors) {
        Morris.Area({
            element: element,
            pointSize: 3,
            lineWidth: 2,
            data: data,
            xkey: xkey,
            ykeys: ykeys,
            labels: labels,
            resize: true,
            hideHover: 'auto',
            gridLineColor: '#eef0f2',
            lineColors: lineColors,
            lineWidth: 0,
            fillOpacity: 0.1,
            xLabelMargin: 10,
            yLabelMargin: 10,
            grid: false,
            axes: false,
            pointSize: 0
        });
    },

    //creates Donut chart
    Dashboard.prototype.createDonutChart = function(element, data, colors) {
        Morris.Donut({
            element: element,
            data: data,
            resize: true,
            colors: colors
        });
    },
    
    Dashboard.prototype.init = function() {

        // --- ЗАМЕНА: вместо статического линейного графика делаем запрос к серверу и рисуем столбчатую диаграмму ---
        var elementId = 'multi-line-chart'; // существующий div в index.blade.php

        // по умолчанию дата отчёта (можно наследовать из data-атрибута шаблона или UI)
        var reportDate = '2025-11-08';

        // Запрос данных с сервера
        $.getJSON('/dashboard/itog-dzhv', { date: reportDate })
            .done(function(resp) {
                if (!Array.isArray(resp) || resp.length === 0) {
                    $('#' + elementId).html('<div class="p-3 text-muted">Нет данных за указанную дату</div>');
                    return;
                }

                // Преобразуем данные в формат для Morris.Bar
                // ожидаем resp: [{id, name, plan, fact, sort_order}, ...]
                var chartData = resp.map(function(d) {
                    return {
                        y: d.name,
                        plan: Number(d.plan) || 0,
                        fact: Number(d.fact) || 0
                    };
                });

                // Опционально: оставить top-N для читаемости (например, 20)
                var topN = 20;
                if (chartData.length > topN) {
                    chartData = chartData.slice(0, topN);
                }

                // Очистим контейнер и отрисуем Morris.Bar
                $('#' + elementId).empty();

                Morris.Bar({
                    element: elementId,
                    data: chartData,
                    xkey: 'y',
                    ykeys: ['plan', 'fact'],
                    labels: ['План', 'Факт'],
                    hideHover: 'auto',
                    resize: true,
                    barColors: ['#40a4f1', '#5b6be8'],
                    gridLineColor: '#eef0f2',
                    xLabelAngle: 45
                });
            })
            .fail(function(xhr) {
                console.error('Ошибка загрузки данных для диаграммы:', xhr);
                $('#' + elementId).html('<div class="p-3 text-danger">Ошибка загрузки данных</div>');
            });

        // --- Конец замены. Ниже оставлены оригинальные примеры для area/donut. ---

        //creating area chart (оригинал)
        var $areaData = [
            {y: '2011', a: 10, b: 15},
            {y: '2012', a: 30, b: 35},
            {y: '2013', a: 10, b: 25},
            {y: '2014', a: 55, b: 45},
            {y: '2015', a: 30, b: 20},
            {y: '2016', a: 40, b: 35},
            {y: '2017', a: 10, b: 25},
            {y: '2018', a: 25, b: 30}
        ];
        this.createAreaChart('morris-area-chart', 0, 0, $areaData, 'y', ['a', 'b'], ['Series A', 'Series B'], ['#00c292', '#03a9f3']);

        //creating donut chart (оригинал)
        var $donutData = [
            {label: "МОСК", value: 12},
            {label: "С ЗАП", value: 30},
            {label: "С-КАВ", value: 20}
        ];
        this.createDonutChart('morris-donut-chart', $donutData, ['#40a4f1', '#5b6be8', '#c1c5e2']);
    },
    //init
    $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.Dashboard.init();
}(window.jQuery);
