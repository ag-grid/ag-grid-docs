<?php
$key = "Column Menu";
$pageTitle = "ag-Grid Javascript Grid Column Menu";
$pageDescription = "Clicking the menu icon on a header brings up the grid's column menu. This page describes how to configure the menu.";
$pageKeyboards = "ag-Grid Javascript Grid Column Menu";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<div>

    <h2><img src="../images/enterprise_50.png" title="Enterprise Feature"/> Column Menu</h2>

    <h3>Showing the Column Menu</h3>

    <p>
        The menu will be displayed by default and will be made up of three panels. If you want to change the order or
        what panels are shown, or hide them, you can specify the property <i>menuTabs</i> in the <i>colDef</i>
    </p>
    <p>
        The property <i>menuTabs</i> is an array of strings. The valid values are: 'filterMenuTab', 'generalMenuTab' and
        'columnsMenuTab'
        <ul>
        <li><b>generalMenuTab</b>: Include in the <i>menuTabs</i> array to show the main panel.</li>
        <li><b>filterMenuTab</b>: Include in the <i>menuTabs</i> array to show the filter panel.</li>
        <li><b>columnsMenuTab</b>: Include in the <i>menuTabs</i> array to show the column selection panel.</li>
    </ul>
        To not show the menu at all, set this property to an empty array<i>[]</i>. In addition, you can set the
    attribute <i>suppressMenu=true</i> to the column definition to not show the menu for a particular column.
    </p>

    <p>
        The order of the menu tabs shown in the menu will match the order you specify in this array
    </p>

    <p>
        If you don't specify a <i>menuTabs</i> for a <i>colDef</i> the default is: <code>['generalMenuTab',
            'filterMenuTab','columnsMenuTab']</code>
    </p>

    <h3>Customising the General Menu Tab</h3>

    <p>
        The main menu panel, by default, will show a set of items. You can adjust which of these items get display, or you
        can start from scratch and provide your own items. To customise the menu, provide the <i>getMainMenuItems()</i>
        callback.
    </p>

    <p>
        <i>getContextMenuItems()</i> takes the following object as parameters:
        <snippet>
GetMainMenuItemsParams {
    column: Column, // the column that was clicked
    api: GridApi, // the grid API
    columnApi: ColumnAPI, // the column API
    context: any, // the grid context
    defaultItems: string[] // list of the items that would be displayed by default
}</snippet>
    </p>

    <p>
        The result of <i>getContextMenuItems()</i> should be a list with each item either a) a string
        or b) a MenuItem description. Use 'string' to pick from built in menu items (listed below)
        and use MenuItem descriptions for your own menu items.
    </p>

    <p>
        A MenuItem description looks as follows (items with question marks are optional):
        <snippet>
MenuItem {
    name: string, // name of menu item
    disabled?: boolean, // if item should be enabled / disabled
    shortcut?: string, // shortcut (just display text, saying the shortcut here does nothing)
    action?: ()=&gt;void, // function that gets executed when item is chosen
    checked?: boolean, // set to true to provide a check beside the option
    icon?: HTMLElement|string, // the icon to display beside the icon, either a DOM element or HTML string
    subMenu?: MenuItemDef[] // if this menu is a sub menu, contains a list of sub menu item definitions
}</snippet>

    <h4>Built In Menu Items</h4>

    <p>The following is a list of all the default built in menu items with the rules about when they are shown.</p>

    <ul>
        <li><b>pinSubMenu</b>: Submenu for pinning. Always shown.</li>
        <li><b>valueAggSubMenu</b>: Submenu for value aggregation. Always shown.</li>
        <li><b>autoSizeThis</b>: Auto-size the current column. Always shown.</li>
        <li><b>autoSizeAll</b>: Auto-size all columns. Always shown.</li>
        <li><b>rowGroup</b>: Group by this column. Only shown if column is not grouped.</li>
        <li><b>rowUnGroup</b>: Un-group by this column. Only shown if column is grouped.</li>
        <li><b>resetColumns</b>: Reset column details. Always shown.</li>
        <li><b>expandAll</b>: Expand all groups. Only shown if grouping by at least one column.</li>
        <li><b>contractAll</b>: Contract all groups. Only shown if grouping by at least one column.</li>
        <li><b>toolPanel</b>: Show the tool panel.</li>
    </ul>

    <p>
        Reading the list above it can be understood that the list <i>defaultItems</i> changes on
        different calls to the <i>getContextMenuItems()</i> callback, depending on, for example,
        what columns are current used for grouping.
    </p>

    <p>
        If you do not provide a <i>getContextMenuItems()</i> callback, then the rules alone decides what gets shown.
        If you do provide a <i>getContextMenuItems()</i>, then the <i>defaultItems</i> will be filled using the
        rules above and you return from the callback whatever you want, using the <i>defaultItems</i> only
        if you want to.
    </p>

    <h4>Menu Item Separators</h4>
    <p>You can add menu item separators as follows:</p>
    <snippet>
menuItems.push('separator')</snippet>

    <?php include './postProcessPopup.php';?>

    <h3>Overriding Column Menu Width</h3>
    <p>You can override the menu width by overriding the corresponding CSS:</p>

    <snippet>
.ag-set-filter-list {
    width: 500px !important;
}</snippet>

    <h3>Example Column Menu</h3>

    <p>
        The example below shows the <i>getMainMenuItems()</i> in action. To demonstrate different scenarios,
        the callback returns something different based on the selected column as follows:
        <ul>
        <li>Athlete column appends custom items to the list of built in items.</li>
        <li>Athlete column contains a sub menu.</li>
        <li>Age column provides custom items and adds one built in default item.</li>
        <li>Country column trims down the default items by removing values.</li>
        <li>Date column changes the order of the tabs to <code>['filterMenuTab','generalMenuTab','columnsMenuTab']</code></li>
        <li>Sport column changes the order of the tabs to <code>['filterMenuTab','columnsMenuTab']</code>. Note that the
        'generalMenuTab' is suppressed.
        <li>Gold column changes the order of the tabs to <code>['generalMenuTab','gibberishMenuTab']</code>. Note that
        the mainTab and columnsTab are suppressed. Also there is a warning on the console letting the user know that
        'gibberishMenuTab' is an invalid option and it is ignored</li>
        <li>Silver column hides the menu by suppressing all the menuTabs that can be shown: <code>[]</code>.</li>
        <li>All other columns return the default list.</li>
        <li><code>postProcessPopup</code> is used on the Gold column to reposition the menu 25px lower.</li>
    </ul>
    </p>

    <?= example('Column Menu', 'column-menu', 'generated', array("enterprise" => 1)) ?>

</div>

<?php include '../documentation-main/documentation_footer.php';?>
