<?php
$key = "Gallery";
$pageTitle = "ag-Grid Gallery";
$pageDescription = "Shows random examples of ag-Grid mixing different parts of the library.";
$pageKeyboards = "ag-Grid Gallery";
$pageGroup = "examples";
include '../documentation-main/documentation_header.php';
?>

<div>

    <h1 class="first-h1" id="icons">Gallery</h1>

    <p>
        This section of the documentation demonstrates different configurations of the grid.
        It is really a mixed bag section, showing combinations of grid features working together that
        doesn't fit into a particular documentation section.
    </p>

    <h2>Auto Height, Full Width & Pagination</h2>

    <p>
        Shows the autoHeight feature working with fullWidth and pagination.
        <ul>
            <li>The fullWidth rows are embedded. This means:
                <ul>
                    <li>Embedded rows are chopped into the pinned sections.</li>
                    <li>Embedded rows scroll horizontally with the other rows.</li>
                </ul>
            </li>
            <li>There are 15 rows and pagination page size is 10, so as you go from
            one page to the other, the grid re-sizes to fit the page (10 rows on the first
                page, 5 rows on the second page).</li>
        </ul>
    </p>

    <?= example('Auto Height & Full Width', 'auto-height-full-width', 'generated') ?>

    <hr/>

    <h2 id="tree-data-vertical-scroll-location">Expanding Groups &amp; Vertical Scroll Location</h2>

    <p>
        Depending on your scroll position the last item's group data may not be visible when
        clicking on the expand icon.
    </p>
    <p>
        You can resolve this by using the function <strong>api.ensureIndexVisible()</strong>.
        This ensures the index is visible, scrolling the table if needed.
    </p>
    <p>
        In the example below, if you expand a group at the bottom, the grid will scroll so all the
        children of the group are visible.
    </p>

    <?= example('Row Group Scroll', 'row-group-scroll', 'generated', array("enterprise" => 1)) ?>

    <h2>Enterprise Row Model & Complex Columns</h2>

    <p>
        This example mixes enterprise row model and complex objects. It shows how you can have value getters
        and embedded fields (ie the field attribute has dot notation).
    </p>

    <p>
        In the example, all rows back are modified so that the rows looks something like this:
    </p>

    <snippet>
row = {
    // country field is complex object
    country: {
        name: 'Ireland',
        code: 'IRE'
    },
    // year field is complex object
    year: {
        name: '2012',
        shortName: "'12"
    },
    // other fields as normal
    ...
};</snippet>

    <p>
        Then the columns are set up so that country uses a <code>valueGetter</code> and year uses a field
        with dot notation, ie <code>year.name</code>
    </p>

    <?= example('Enterprise Complex Objects', 'enterprise-complex-objects', 'generated', array("enterprise" => 1)) ?>

    <h2>Flower Nodes</h2>

    <p>
        Version 14.2 of ag-Grid introduced full support for Master / Detail. Before this, users had
        to implement master / detail using flower nodes. Flower nodes are now deprecated. However to
        check for backwards compatibility, flower node examples are presented here for regression
        testing purposes.
    </p>

    <p>
        Below shows using flower nodes to provide a master / detail experience.
    </p>

    <?= example('Flower Nodes', 'flower-nodes', 'generated') ?>

</div>

<?php include '../documentation-main/documentation_footer.php';?>
