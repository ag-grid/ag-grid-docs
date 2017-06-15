<?php
$key = "Row Models";
$pageTitle = "Row Models";
$pageDescription = "ag-Grid can be configured to retrieve rows from the server in different ways. Select which way is best for your application.";
$pageKeyboards = "Javascript Grid Row Model Pagination Infinate Scrolling";
$pageGroup = "row_models";
include '../documentation-main/documentation_header.php';
?>

<div>

    <h2 id="row-models">
        <img src="../images/svg/docs/row_models.svg" width="50" />
        Row Models
    </h2>

    <p>
        The grid follows an MVC pattern. Each data item is wrapped in a <b>Row Node</b> and then
        stored in a <b>Row Model</b>. The grid rendering engine listens for changes to the row model
        and draws rows on the screen when the rows change (eg after a filter or a sort is applied).
    </p>

    <p>
        Depending on your needs, the grid can be configured with different row models. The row models
        differ in how the data is loaded. You can load all the data and hand it
        over to the grid (In Memory Row Model) or you can keep most of the data on the server
        and lazy-load based on what is currently visible to the user (Infinite Scrolling,
        Viewport and Enterprise Row Models).
    </p>
    <p>
        The following is a summary of the different row models:
        <ul>
            <li><a href="../javascript-grid-in-memory/"><b>In Memory:</b></a> This is the default. The grid will load all of the data into the grid in one go.
            The grid can then perform filtering, sorting, grouping, pivoting and aggregation all in memory.</li>
            <li><a href="../javascript-grid-infinite-scrolling/"><b>Infinite Scrolling:</b></a> This will present the data to the user in one screen with a vertical scrollbar.
                The grid will retrieve the data from the server in blocks using a least recently used algorithm to
                cache the blocks on the client. Use this if you have a large (to large to bring back from the server
                in one go) and flat list (not grouped) of data that you want to show to the user.</li>
            <li><a href="../javascript-grid-viewport/"><b>Viewport:</b></a> This will present the data to the user on screen with a vertical scrollbar.
                The grid will inform the server exactly what data it is displaying (first and last row) and the
                server will provide data for exactly those rows only. Use this if you want the server to know exactly
                what the user is viewing, typically used for updates in live datastreams (as server knows exactly
                what each user is looking at).</li>
            <li><a href="../javascript-grid-enterprise-model/"><b>Enterprise:</b></a>
                Enterprise allows lazy loading of grouped data with server side grouping and aggregation
                with slice and dice capability. Use this if you want the user to experience grouping and / or
                aggregations that are done on the server side, or if you want the user to navigate very large
                datasets of grouped data, or you simple want to lazy load group data.</li>
        </ul>
    </p>

    <h3>Light Overview of Row Model</h3>

    <p>
        Below shows a very cut down and simplistic class diagram of the interaction between
        the grid's rendering engine (RowRenderer) and the Row Models.
    </p>

    <p>
        <img src="./rowModels.png"/>
    </p>

    <p>
        The following should be noted from the diagram:
        <ul>
            <li>
                The grid has exactly one <b>RowRenderer</b> instance. The RowRenderer contains a reference to the PaginationProxy
                where it asks for the rows one at a time for rendering.
            </li>
            <li>
                The grid has exactly one <b>PaginationProxy</b> instance. The PaginationProxy will either a) do nothing
                if pagination is not active and just forward all requests to the Row Model or b) do pagination if
                pagination is active. The PaginationProxy has exactly one RowModel instance.
            </li>
            <li>
                You can configure the grid to use any of the provided <b>Row Models</b> - that's why RowModel is in
                italics, it means it's an interface, the concrete implementation is what you decide at run time.
                The RowModel contains a list of RowNodes. The RowModel may have a list of all the RowNodes (In Memory Row Model) or have
                a DataSource where it can lazy load RowNodes
            </li>
            <li>
                A <b>RowNode</b> has a reference to exactly one row data item (the client application provides
                the row data items). The RowNode has state information about the row item, such as whether it is
                selected and the height of it.
            </li>
            <li>
                When there is a change in state in the RowNodes, the RowModel fires a <b>modelUpdated</b>
                event which gets the RowRenderer to refresh. This happens for many reasons, or example the
                data is sorted, filtered, a group is opened, or the underlying data has changed.
            </li>
        </ul>
    </p>

    <style>
        .row-model-table .item-row {
            border-top: 1px solid lightgray;
        }
        .row-model-table .first-row {
            background-color: aliceblue;
            font-weight: bold;
        }

        .row-model-table td {
            padding: 4px;
            border-left: 1px solid lightgray;
        }

        .row-model-table {
            border-top: 1px solid lightgray;
            border-bottom: 1px solid lightgray;
            border-right: 1px solid lightgray;
        }
    </style>

    <h3 id="row-model-summary">Row Model Comparisons</h3>

    <p>
        The following table compares the row models highlights.
    </p>

    <p>
        <table class="row-model-table">
            <tr class="first-row">
                <td>Model</td>
                <td>Sorting & Filtering</td>
                <td>Grouping & Aggregation</td>
                <td>Server State**</td>
                <td>Availability</td>
            </tr>
            <tr class="item-row">
                <td><a href="../javascript-grid-in-memory/"><b>In Memory</b></a></td>
                <td>Inside the Grid</td>
                <td>Inside the Grid*</td>
                <td>Stateless</td>
                <td>ag-Grid (Free)</td>
            </tr>
            <tr class="item-row">
                <td><a href="../javascript-grid-infinite-scrolling/"><b>Infinite Scrolling</b></a></td>
                <td>Server Side</td>
                <td>No</td>
                <td>Stateless</td>
                <td>ag-Grid (Free)</td>
            </tr>
            <tr class="item-row">
                <td><a href="../javascript-grid-viewport/"><b>Viewport</b></a></td>
                <td>Server Side</td>
                <td>No</td>
                <td>Stateful</td>
                <td>ag-Grid Enterprise</td>
            </tr>
            <tr class="item-row">
                <td><a href="../javascript-grid-enterprise-model/"><b>Enterprise</b></a></td>
                <td>Server Side</td>
                <td>Server Side</td>
                <td>Stateless</td>
                <td>ag-Grid Enterprise</td>
            </tr>
        </table>
    </p>

    <p>
        * Grouping and Aggregation for the In Memory row model is available in ag-Grid Enterprise only.
    </p>
    <p>
        ** Server State means your server is aware of client state. For viewport, the server knows exactly
        what each user is currently looking at, whereas all other row models access the server is a stateless
        fashion.
    </p>

    <h3 id="setting-row-model">Setting Row Model</h3>

    <p>
        What row model you use is set as a grid property. Set it to one of <i>{normal, infinite, viewport, enterprise}</i>.
        The default is <i>normal</i>.
    </p>

    <h3 id="when-to-use">When to Use</h3>

    <p>
        Which row model you use will depend on your application. Here are some rules of thumb:
        <ul>
            <li>
                If you are not sure, use default <b><a href="../javascript-grid-in-memory/">In Memory</a></b>.
                The grid can handle massive (100k+) amounts of data. The grid will only
                render what's visible on the screen (40 rows approx???) even if you have thousands of rows returned from your
                server. You will not kill the grid with too much data - rather your browser will run out of memory before
                the grid gets into problems. So if you are unsure, go with In Memory row model first and only change if you need another.
                With In Memory, you get sorting, filtering, grouping, pivoting and aggregation all done for you by the grid.
                You can also provide your own filters, sorts and aggregation functions to customise these operations.
                All of the examples in the documentation use the In Memory model unless specifically specified
                otherwise.
            </li>
            <li>
                If you do not want to shift all the data from your server to your client, as the amount of data is too
                large to shift over the network or to extract from the underlying datasource, then use on of viewport,
                infinite scrolling or enterprise. Each one takes data from the server in different ways.
            </li>
            <li>
                Use <b><a href="../javascript-grid-infinite-scrolling/">Infinite Scrolling</a></b>
                to bring back a list of data one block at a time from the server.
                As the user scrolls down the grid will ask for more rows.
                This is the easiest way to present a large dataset to the user while only loading a subset from the
                server at any given time.
            </li>
            <li>
                Use <b><a href="../javascript-grid-viewport/">Viewport</a></b> if you want the server to know exactly what the user is looking at.
                This is best when you have a large amount of changing data and want to push updates
                to the client when the server side data changes. Knowing exactly what the user is looking
                at means you only have to push updates to the relevant users.</li>
            </li>
            <li>
                Use <b><a href="../javascript-grid-enterprise-model/">Enterprise</a></b> if you want to load large amounts of data that is grouped, or you want
                to allow the user to slice and dice data from the client. This is best used for reporting
                applications or other applications that need to present large amounts of hierarchical data.
            </li>
        </ul>
    </p>

    <h2 id="datasource">Pagination</h2>

    <p>
        Pagination can be applied to any of the row model types. The documentation on each row model
        type covers pagination for that row model type.
    </p>

    <h2 id="datasource">Grid Datasource</h2>

    <p>
        The <a href="../javascript-grid-in-memory/">In Memory</a> row model does not need a datasource.
        <a href="../javascript-grid-infinite-scrolling/">Infinite Scrolling</a>,
        <a href="../javascript-grid-viewport/">Viewport</a> and
        <a href="../javascript-grid-enterprise-model/">Enterprise</a> all use a datasource. The documentation
        on each row model type explains how to configure the datasource for the particular row model.
    </p>

</div>

<?php include '../documentation-main/documentation_footer.php';?>