<?php
$key = "Width & Height";
$pageTitle = "ag-Grid Width and Height";
$pageDescription = "ag-Grid Resizing";
$pageKeyboards = "ag-Grid Resizing";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<div>

    <h2 id="width-and-height">Grid Size</h2>

    <p>
        The grid width and height should be set using CSS width and height styles.
        This can be done using pixels or percentages.
    </p>

    <pre><span class="codeComment">// set width using percentages</span>
&lt;div id="myGrid" class="ag-fresh" <b>style="width: 100%; height: 100%;"</b>>&lt;/div>

<span class="codeComment">// OR set width using fixed pixels</span>
&lt;div id="myGrid" class="ag-fresh" <b>style="width: 500px; height: 200px;"</b>>&lt;/div></pre>

    <h3 id="percent-width-and-height">Pitfall When Using Percent Width & Height</h3>

    <p>
        If using % for your height, then make sure the container you are putting the grid into
        also has height specified, as the browser will fit the div according to a percentage of
        the parents height, and if the parent has no height, then this % will always be zero.
        If your grid is not using all the space you think it should, then put a border on the grid's
        div and see if that's the size you want (the grid will fill this div). If it is not the size
        you want, then you have a CSS layout issue to solve outside of the grid.
    </p>

    <h3 id="changing-width-and-height">Changing Width and Height</h3>

    <p>
        If the width and / or height change after the grid is initialised, the grid will
        automatically resize to fill the new area.
    </p>

    <p>
        There is no JavaScript event for when an element changes size (there is a window resized
        event, but no element resized) so the grid checks its size every 500ms. If your application
        changes the size of the grid, you can get the grid to resize immediatly (rather than wait
        for the next 500ms check) by calling <i>api.doLayout()</i>.
    </p>

    <h3 id="example-width-and-height">Example: Setting and Changing Grid Width and Height</h3>

    <p>
        The example below shows setting the grid size and then changing it as the user
        selects the buttons. Notice that the example calls <i>api.doLayout()</i> after
        the resize to avoid a flicker.
    </p>

    <show-example example="exampleWidthAndHeight"></show-example>

    <h2>Grid Layout</h2>

    <p>
        There is a property <i>gridLayout</i> which changes how the grid is laid into the DOM.
        By default the grid will have horizontal and vertical scrolls which will meet your needs
        95 of the time. So don't change the <i>gridLayout</i> property unless you want one
        of the following:
    </p>

    <p>
        <ul>
            <li><b>Auto Height: </b>The auto height (explained below) allows the grid to resize based
            on the number of rows so that there is no vertical scrolls. Use this if you have relatively
            few rows in your grid and want to pack them into your webpage (so that there is no blank
            area in the screen where the grid is bigger than needed for the rows that you have).</li>
            <li><b>For Print: </b>The <a href="../javascript-grid-for-print/">for print</a> will have
            no scrolls, very bad for performance (as a large grid will create a lot of DOM) however
            ideal if you want to print the grid, as it will remove all scrolls and pinned areas,
            so that every element is rendered into the DOM.</li>
        </ul>
    </p>

    <h2 id="autoHeight">Auto Height Grid</h2>

    <p>
        Most applications will give the grid a fixed height and then the grid will provide vertical scrolls
        to navigate through the rows. This is the best way to view large data sets, as it allows the grid to
        only render rows that are currently visible on the screen. For example if you can only see 20 rows,
        then the grid will only render 20 rows, and as you scroll down, rows will be removed and new rows drawn.
    </p>

    <p>
        Some applications will want to render all the rows in the grid and not use and scrolls inside the grid.
        This will give bad performance if many rows (ie if you render 10,000 rows into the DOM, your browser will
        probably crash!), however for 10 or 20 rows, this may be preferred.
    </p>

    <p>
        To have the grid auto-size to fit the provided rows, set the property <code>domLayout='autoHeight'</code>
    </p>

    <p>
        The example below demonstrates the autoHeight feature. Notice the following:
        <ul>
            <li>As you set different numbers of rows into the grid, the grid will resize it's height to just fit the rows.</li>
            <li>As the grid height exceeds the height of the browser, you will need to use the browser vertical scroll
            to view data (or the iFrames scroll if you are looking at the example embedded below).</li>
            <li>The height will also adjust as you filter, to add and remove rows.</li>
            <li>If you have floating rows, the grid will size to accommodate the floating rows.</li>
            <li>Vertical scrolling will not happen, however horizontal scrolling, including pinned columns, will work as normal.</li>
        </ul>
    </p>

    <note>
        The following test is best viewed if you open it in a new tab, so it is obvious that there are no scroll bars.
        Note that if you use the example inlined the scroll bars shown are for the containing iframe, not the grid.
    </note>
    <show-example example="exampleAutoHeight"></show-example>

    <h3>Animation with Auto Height</h3>

    <p>
        The autoHeight will do a complete refresh of the grid rows after any sort, filter or row group open
        / close. This also means row animation will not work with autoHeight.
        This is because the autoHeight feature just places the rows into the DOM and lets the browser lay them
        out naturally. Under normal operation (when not using autoHeight) the grid explicitly positions the rows
        using top pixel location - which is needed for the animations to work.
    </p>

    <h4>Full Width and Auto Height</h4>

    <p>
        The <a href="../javascript-grid-full-width-rows/">fullWidth</a> feature, when used with autoHeight,
        will always <a href="../javascript-grid-full-width-rows/#embeddedFullWidth">embed the full width rows</a>.
        This means if using fullWidth, the fullWidth rows will scroll horizontally with the other rows and if
        pinning, the fullWidth row will be split into the pinned sections.
    </p>

    <h2>Max Rows in Grid</h2>

    <p>
        Browsers have a <a href="https://stackoverflow.com/questions/7719273/determine-maximum-possible-div-height">
        maximum height on divs</a> that puts a hard limit on the number of rows that can be displayed.
        In Internet Explorer, this limit can be observed limiting the rows to 65,000 rows when on the
        <a href="../example.php">main demo</a>.
    </p>
    <p>
        Currently ag-Grid has no way to extending this limit to allow viewing more rows simultaneously. However
        this is not a problem 99.99% of the time (the only people who this appears to be a problem with is
        system testers!!).
    </p>
    <p>
        The reason this is not a problem is that normal human users don't scroll through tens of thousands
        of rows. Instead the grid will happily take the rows and then the user will use
        group / filter / sort to get to the data that they want.
    </p>
</div>

<?php include '../documentation-main/documentation_footer.php';?>
