<?php
$key = "Quick Filter";
$pageTitle = "JavaScript Grid Quick Filter";
$pageDescription = "ag-Grid comes with a quick filter. This sections explains how to use the quick filter.";
$pageKeyboards = "ag-Grid Quick Filter";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<h2 id="quickFilter">Quick Filter</h2>

<p>
    In addition to the column specific filtering, a 'quick filter' (influenced by how filtering is done in Google
    GMail) can also be applied. Set the quick filter by using the Grid's API:

    <pre>api.setQuickFilter('new filter text');</pre>

    If you are using a framework such as Angular or React, you can set bind the quick filter text to the
    <code>quickFilter</code> attribute.
</p>

<h3 id="overridingQuickFilter">Overriding the Quick Filter Value</h3>

<p>
    If your data contains complex objects, then the quick filter will end up with [object,object] inside it
    instead of searchable string values. Or maybe you want to format string values for searching (eg take out
    accent characters, or take out commas from numbers). If you want to do this, then provide a <i>getQuickFilterText</i>
    to the column definition, eg:
<pre>colDef = {
    headerName: "D", field: "d",
    getQuickFilterText: function(params) {
        return params.value.name;
    }
}</pre>
Params contains {value, node, data, column, colDef}.
</p>
<note>
    You only need to override the quick filter value if you have a problem. If you don't have a quick filter
    problem, you don't need to use it, quick filter will work 'out of the box' in most cases.
</note>

<h3 id="how-it-works">Quick Filter Cache</h3>

<p>
    By default, the quick filter checks each columns value, including running it's value getters
    if present, each time the quick filter is executed. If your data set is large, you may wish
    to enable the quick filter cache by setting <code>cacheQuickFilter=true</code>.
</p>

<p>
    When the cache is enabled, each node gets a 'quick filter text' attached to it by
    concatenating all the values for each column. For example, a {Employee Name, Job} table could have a
    row with quick filter text of 'NIALL CROSBY\nCOFFEE MAKER'.
    The grid then does a simple string search, so if you search for 'Niall', it will find our example text.
    Joining all the columns values into one string gives a huge performance boost. The values
    are joined after the quick filter is requested for the first time and stored in the rowNode - the original
    data that you provide is not changed.
</p>

<h4 id="reset-quick-filters">Reset Cache Text</h4>

<p>Quick filter cache text can be reset in any of the following ways:
<ul>
    <li>Each rowNode has a <code>resetQuickFilterAggregateText</code> method on it - call this to reset the quick filter</li>
    <li><code>rowNode.setDataValue(colKey, newValue)</code> will also reset the quick filter</li>
    <li>Lastly, if using the grid editing features, when you update a cell, the quick filter will get reset.</li>
</ul>
</p>

<p>
    If you are not using the cache setting, then you can ignore all this.
</p>

<h3 id="quick-filter-example">Quick Filter Example</h3>

<p>
    The example below shows the quick filter working on different data types. Each column demonstrates something
    different as follows:
</p><ul>
        <li>A - Simple column, nothing complex.</li>
        <li>B - Complex object with 'dot' in field, quick filter works fine.</li>
        <li>C - Complex object and value getter used, again quick filter works fine.</li>
        <li>D - Complex object, quick filter would call 'toString' on the complex object, so getQuickFilterText is provided.</li>
        <li>E - Complex object, not getQuickFilterText provided, so the quick filter text ends up with '[object,object]' for this column.</li>
    </ul>

    The example also demonstrates using the cache vs not using the cache. Selecting one of the following
    will reset the grid and work as follows:
    <ul>
        <li><b>Normal Quick Filter:</b> The cache is not used. Value getters are executed on each node each
            time the filter is executed.</li>
        <li><b>Cache Quick Filter:</b> The cache is used. Value getters are executed first time the quick
            filter is run.</li>
    </ul>

    To see the quick filter text attached to each node while using the cache, click 'Print Quick Filter Texts'
    button after you execute the quick filter at least one. You will notice the quick filter text is correct
    for each column except E (which would be fixed by adding an appropriate getQuickFilterText method like D does).
</p>

<!-- todo-plunk plunker="https://embed.plnkr.co/XlK0mtmxrKZjYOn3t56x/" -->
<show-complex-example example="exampleQuickFilter.html"
                      sources="{
                                [
                                    { root: './', files: 'exampleQuickFilter.html,exampleQuickFilter.js' }
                                ]
                              }"
                      exampleheight="500px">
</show-complex-example>

<h3 id="server-side-filtering">Server Side Data</h3>

<p>
    Quick Filters only make sense with client side data (i.e. when using the In Memory row model).
    For the other row models (<a href="../javascript-grid-pagination/">pagination</a>,
    <a href="../javascript-grid-virtual-paging/">infinite scrolling</a> etc) you would need to implement your own server side sorting to
    replicate Quick Filter functionality.</p>


</p>



<?php include '../documentation-main/documentation_footer.php';?>
