<?php
$key = "RTL";
$pageTitle = "ag-Grid RTL";
$pageDescription = "ag-Grid RTL";
$pageKeyboards = "ag-Grid RTL";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<div>

    <h2 id="right-to-left">RTL - Right To Left</h2>

    <p>
        RTL is used for displaying languages that go from Right to Left, eg Hebrew and Arabic.
        To get ag-Grid to display in RTL format, set the property <i>enableRtl=true</i>.
    </p>

    <h3 id="simple-example">Simple Example</h3>

    <p>
        Below shows a simple example of a grid using RTL. To make it look better we should really be using
        an RTL language, however none of us in ag-Grid know any RTL languages, so we are sticking with English.
    </p>

    <?= example('RTL Simple', 'rtl-simple', 'generated') ?>

    <h3 id="complex-example">Complex Example</h3>

    <p>
        Below shows a more complex example. It's the same example as used on the ag-Grid main demo page.
        To demonstrate all the edge cases of RTL, the tool panel and pinned areas are shown. This example
        is using ag-Grid Enterprise - hence the tool panel and context menu's are active.
    </p>

    <?= example('RTL Complex', 'rtl-complex', 'vanilla', array("enterprise" => 1)) ?>

    <h3 id="how-it-works">How it Works</h3>

    <p>
        If you are creating your own theme, knowing how the RTL is implemented will be useful.
    </p>

    <h4 id="css-styling">CSS Styling</h4>

    <p>
        The following CSS classes are added to the grid when RTL is on and off:
        <ul>
        <li><b>ag-rtl</b>: Added when RTL is ON. It sets the style <i>'direction=rtl'</i>.</li>
        <li><b>ag-ltr</b>: Added when RTL is OFF. It sets the style <i>'direction=ltr'</i>.</li>
    </ul>
        You can see these classes by inspecting the DOM of ag-Grid. A lot of the layout of the grid
        is reversed with this simple CSS class change.
    </p>

    <p>
        Themes then also use these styles for adding different values based on whether RTL is used or NOT.
        For example, the following is used inside the provided themes:
    </p>
    <snippet>
// selection checkbox gets 4px padding to the RIGHT when LTR
.ag-ltr .ag-selection-checkbox {
    padding-right 4px;
}

// selection checkbox gets 4px padding to the LEFT when RTL
.ag-rtl .ag-selection-checkbox {
    padding-left 4px;
}</snippet>

    <h4 id="pinning-and-scroll-bars">Pinning and Scroll Bars</h4>

    <p>
        Under normal operation, when columns are pinned to the right, the vertical scroll will appear
        alongside the right pinned panel. For RTL the scroll will appear on the left pinned panel
        when left pinning columns.
    </p>

    <h4 id="layout-of-columns">
        Layout of Columns
    </h4>

    <p>
        The grid normally lays the columns out from left to right. When doing RTL the columns go
        from the right to the left. If the grid was using normal HTML layout, then the columns
        would all reverse by themselves, however the grid used Column Visualisation, so it needs
        to know exactly where each column is. Hence there is a lot of math logic inside ag-Grid
        that is tied with the scrolling. Not only is the scrolling inverted, all the maths logic
        is inverted also. All of this is taken care of for you inside ag-Grid. Once <i>enableRtl=true</i>
        is set, the grid will know to use the RTL varient of all the calculations.
    </p>

</div>

<?php include '../documentation-main/documentation_footer.php';?>
