var columnDefs = [
    {headerName: "Athlete", field: "athlete", width: 150},
    {headerName: "Country", field: "country", width: 120, rowGroupIndex: 0},
    {headerName: "Year", field: "year", width: 90},
    {headerName: "Gold", field: "gold", width: 100, aggFunc: 'sum'},
    {headerName: "Silver", field: "silver", width: 100, aggFunc: 'sum'},
    {headerName: "Bronze", field: "bronze", width: 100, aggFunc: 'sum'}
];

var rowData = [
    { athlete: 'Niall Crosby', country: 'Ireland', year: '2016', gold: 10, silver: 10, bronze: 10 },
    { athlete: 'Jillian Crosby', country: 'Ireland', year: '2016', gold: 5, silver: 5, bronze: 5 },
    { athlete: 'John Masterson', country: 'Ireland', year: '2016', gold: 2, silver: 2, bronze: 2 },
    { athlete: 'Lucy Somebody', country: 'UK', year: '2016', gold: 2, silver: 2, bronze: 2 },
    { athlete: 'Sean Landsman', country: 'South Africa', year: '2016', gold: 2, silver: 2, bronze: 2 },
    { athlete: 'Jack Elephant', country: 'South Africa', year: '2016', gold: 2, silver: 2, bronze: 2 },
    { athlete: 'Tiger Woods', country: 'South Africa', year: '2016', gold: 2, silver: 2, bronze: 2 },
    { athlete: 'Jack Steel', country: 'Germany', year: '2016', gold: 2, silver: 2, bronze: 2 },
    { athlete: 'Mike NoMagic', country: 'Sweden', year: '2016', gold: 2, silver: 2, bronze: 2 }
];

var groupRemoveSingleChildren = true;

var gridOptions = {
    columnDefs: columnDefs,
    rowData: rowData,
    groupColumnDef: {
        headerName: 'Country',
        cellRenderer: 'group',
        field: 'country'
    },
    groupRemoveSingleChildren: groupRemoveSingleChildren,
    animateRows: true,
    groupDefaultExpanded: 1,
    suppressAggFuncInHeader: true
};

function setupGrid() {
    var gridDiv = document.querySelector('#myGrid');
    new agGrid.Grid(gridDiv, gridOptions);
    gridOptions.api.sizeColumnsToFit();
}

function toggleGrid() {
    groupRemoveSingleChildren = !groupRemoveSingleChildren;
    gridOptions.api.setGroupRemoveSingleChildren(groupRemoveSingleChildren);
}

// setup the grid after the page has finished loading
document.addEventListener('DOMContentLoaded', function() {
    setupGrid();
});
