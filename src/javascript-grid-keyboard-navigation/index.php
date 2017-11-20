<?php
$key = "Keyboard Navigation";
$pageTitle = "ag-Grid Keyboard Navigation";
$pageDescription = "ag-Grid Keyboard Navigation";
$pageKeyboards = "ag-Grid Keyboard Navigation";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<div>

    <h1 id="keyboard-navigation">Keyboard Navigation</h1>

    <p>
        Clicking on a cell gives the cell focus. You can then navigate and interact with the grid in the
        following ways...
    </p>

    <h3 id="navigation">Navigation</h3>

    <p>
        Use the <b>arrow keys</b> to move focus to the selection up, down, left and right. If the selected cell is
        already on the boundary for that position (eg if on the first column and the left key is pressed)
        then the key press has no effect. User <b>ctrl + left and right</b> to move to start and end of the
        line.
    </p>

    <p>
        Use <b>page up</b> and <b>page down</b> to move the scroll up and down by one page.
        Use <b>home</b> and <b>end</b> to go to the first and last rows.
    </p>

    <p>
        If using grouping and <i>groupUseEntireRow=true</i>, then the group row is not focusable. When
        navigating, the grouping row is skipped.
    </p>

    <h3 id="groups">Groups</h3>

    <p>
        If on a group element, hitting the <b>enter key</b> will expand or collapse the group. This only works
        when displaying groups in a column (<i>groupUseEntireRow=false</i>), as otherwise the group cell
        is not selectable.
    </p>

    <h3 id="editing">Editing</h3>

    <p>
        Pressing the <b>enter key</b> on a cell will put the cell into edit mode, if editing is allowed on the cell.
        This will work for the default cell editor.
    </p>

    <h3 id="selection">Selection</h3>

    <p>
        Pressing the <b>space key</b> on a cell will select the cells row, or deselect the row if already selected.
        If multi-select is enabled, then the selection will not remove any previous selections.
    </p>

    <h3 id="custom-actions">Custom Actions</h3>

    <p>
        Custom cell renderers can listen to key presses on the focused div. The grid element that receives
        the focus is provided to the cell renderers via the <i>eGridCell</i> parameter. You can add your
        own listeners to this cell. Via this method you can listen to any key press and do your own action
        on the cell eg hitting 'x' may execute a command in your application for that cell.
    </p>

    <h3 id="suppress-cell-selection">Suppress Cell Selection</h3>

    <p>
        If you want keyboard navigation turned off, then set <i>suppressCellSelection=true</i> in the <i>gridOptions</i>.
    </p>

    <h3>Example</h3>

    <p>
        All the items above (navigation, editing, groups, selection) are observable in the test drive.
        As such, a separate example is not provided here.
    </p>

    <h3 id="customNavigation">Custom Navigation</h3>

    <p>
        Most people will be happy with the default navigation the grid does when you use the arrow keys
        and the tab key. Some people will want to override this - for example maybe you want the tab key
        to navigate to the cell below, not the cell to the right. To facilitate this, the grid offers
        two methods: <i>navigateToNextCell</i> and <i>tabToNextCell</i>.
    </p>

    <h3 id="navigate-to-next-cell">navigateToNextCell</h3>

    <p>
        Provide a callback <i>navigateToNextCell</i> if you want to override the arrow key navigation. The
        function signature is as follows:
    </p>

    <snippet>
interface NavigateToNextCellParams {

    // the keycode for the arrow key pressed, left = 37, up = 38, right = 39, down = 40
    key: number;

    // the cell that currently has focus
    previousCellDef: GridCellDef;

    // the cell the grid would normally pick as the next cell for this navigation
    nextCellDef: GridCellDef;
}</snippet>

    <h3 id="tab-to-next-cell">tabToNextCell</h3>

    <p>
        Provide a callback <i>tabToNextCell</i> if you want to override the tab key navigation. The
        parameter object is as follows:
    </p>

    <snippet>
interface TabToNextCellParams {

    // true if the shift key is also down
    backwards: boolean;

    // true if the current cell is editing (you may want to skip cells that are not editable,
    // as the grid will enter the next cell in editing mode also if tabbing)
    editing: boolean;

    // the cell that currently has focus
    previousCellDef: GridCellDef;

    // the cell the grid would normally pick as the next cell for this navigation
    nextCellDef: GridCellDef;
}</snippet>

    <h3 id="grid-cell-def">GridCellDef</h3>

    <p>
        Both functions above use GridCellDef. This is an object that represents a cell in the grid. Its
        interface is as follows:
    </p>

    <snippet>
interface GridCellDef {

    // either 'top', 'bottom' or undefined/null (for not floating)
    floating: string;

    // a positive number from 0 to n, where n is the last row the grid is rendering
    rowIndex: number;

    // the grid column
    column: Column;
}</snippet>

    <p>
        The functions take a GridCellDef for current and next cells, as well as returning a GridCellDef object.
        The returned GridCellDef will be the one the grid puts focus on next. Return the provided <i>nextCellDef</i>
        to stick with the grid default behaviour. Return null/undefined to skip the navigation.
    </p>

    <h3 id="example-custom-navigation">Example Custom Navigation</h3>

    <p>
        The example below shows both <i>navigateToNextCell</i> and <i>tabToNextCell</i> in practice.
        <i>navigateToNextCell</i> swaps the up and down arrow keys. <i>tabToNextCell</i> uses tabbing
        to go up and down rather than right and left.
    </p>

    <?= example('Custom Keyboard Navigation', 'custom-keyboard-navigation', 'generated') ?>


    <h1 id="tabbing-into-grid">Tabbing into the Grid</h1>

    <p>
        In applications where the grid is embedded into a larger page it may be useful to tab into grid from another
        element or user action such as a button click.
    </p>

    <p>
        This can be achieved by using a combination of DOM event listeners and Grid API calls shown in the following code
        snippet:
    </p>

    <snippet>
// obtain reference to input element
var myInput = document.getElementById("my-input");

// intercept key strokes within input element
myInput.addEventListener("keydown", function (event) {
    // code for tab key
    var tabKeyCode = 9;

    // ignore non tab key strokes
    if(event.keyCode !== tabKeyCode) return;

    // prevents tabbing into the url section
    event.preventDefault();

    // scrolls to the first row
    gridOptions.api.ensureIndexVisible(0);

    // scrolls to the first column
    var firstCol = gridOptions.columnApi.getAllDisplayedColumns()[0];
    gridOptions.api.ensureColumnVisible(firstCol);

    // sets focus into the first grid cell
    gridOptions.api.setFocusedCell(0, firstCol);

}, true);
</snippet>

    <h3>Example - Tabbing into the Grid</h3>

    <p>
        In the following example there is an input box provided to test tabbing into the grid. Notice the following:

        <ul>
            <li>
                Tabbing out of the input box will gain focus on the first grid cell.
            </li>
            <li>
                When the first cell is out of view due to either scrolling down (rows) or across (columns), tabbing out
                of the input will cause the grid to navigate to the first cell.
            </li>
        </ul>
    </p>


    <?= example('Tabbing into the Grid', 'tabbing-into-grid', 'vanilla') ?>

</div>

<?php include '../documentation-main/documentation_footer.php';?>
