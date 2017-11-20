var columnDefs = [
    {headerName: 'Country', field: 'country', width: 120, rowGroup: true},
    {headerName: 'Year', field: 'year', width: 90, pivot: true},
    {headerName: 'Gold', field: 'gold', width: 100, aggFunc: 'sum'},
    {headerName: 'Silver', field: 'silver', width: 100, aggFunc: 'sum'},
    {headerName: 'Bronze', field: 'bronze', width: 100, aggFunc: 'sum'}
];

var gridOptions = {
    columnDefs: columnDefs,
    enableColResize: true,
    enableSorting: true,
    suppressAggFuncInHeader: true,
    pivotMode: true
};

function clearSort() {
    gridOptions.api.setSortModel({});
}

function sort2000Bronze() {
    var column = findIdForColumn('2000', 'bronze', gridOptions.columnApi.getAllGridColumns());
    var sort = [{colId: column.getId(), sort: 'desc'}];
    gridOptions.api.setSortModel(sort);
}

function sort2002Gold() {
    var column = gridOptions.columnApi.getSecondaryPivotColumn(['2002'], 'gold');
    var sort = [{colId: column.getId(), sort: 'desc'}];
    gridOptions.api.setSortModel(sort);
}

function findIdForColumn(year, medal, pivotColumns) {
    var foundColumn;

    pivotColumns.forEach(function(column) {
        var pivotKeys = column.getColDef().pivotKeys;
        var pivotKey = pivotKeys[0];
        var pivotKeyMatches = pivotKey === year;

        var pivotValueColumn = column.getColDef().pivotValueColumn;
        var pivotValueColId = pivotValueColumn.getColId();
        var pivotValueMatches = pivotValueColId === medal;

        if (pivotKeyMatches && pivotValueMatches) {
            foundColumn = column;
        }
    });

    return foundColumn;
}

// setup the grid after the page has finished loading
document.addEventListener('DOMContentLoaded', function() {
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);

    // do http request to get our sample data - not using any framework to keep the example self contained.
    // you will probably use a framework like JQuery, Angular or something else to do your HTTP calls.
    var httpRequest = new XMLHttpRequest();
    httpRequest.open('GET', 'https://raw.githubusercontent.com/ag-grid/ag-grid-docs/master/src/olympicWinners.json');
    httpRequest.send();
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState === 4 && httpRequest.status === 200) {
            var httpResult = JSON.parse(httpRequest.responseText);
            gridOptions.api.setRowData(httpResult);
        }
    };
});