var masterColumnDefs = [
    // group cell renderer needed for expand / collapse icons
    {field: 'name', cellRenderer: 'group'},
    {field: 'account'},
    {field: 'calls'},
    {field: 'minutes', valueFormatter: "x.toLocaleString() + 'm'"}
];

var detailColumnDefs = [
    {field: 'callId'},
    {field: 'direction'},
    {field: 'number'},
    {field: 'duration', valueFormatter: "x.toLocaleString() + 's'"},
    {field: 'switchCode'}
];

var detailGridOptions = {
    columnDefs: detailColumnDefs,
    onGridReady: function(params) {
        params.api.sizeColumnsToFit();
    }
};

var masterGridOptions = {
    columnDefs: masterColumnDefs,
    rowData: rowData,
    masterDetail: true,
    detailCellRendererParams: {
        detailGridOptions: detailGridOptions,
        getDetailRowData: function (params) {

            // simulate delayed supply of data to the detail pane
            setTimeout(function () {
                params.successCallback(params.data.callRecords);
            }, 1000);
        }
    },
    onGridReady: function(params) {
        params.api.sizeColumnsToFit();
    }
};

// setup the grid after the page has finished loading
document.addEventListener('DOMContentLoaded', function() {
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, masterGridOptions);
});