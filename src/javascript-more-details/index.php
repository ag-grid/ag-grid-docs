<?php
$key = "More Detail Javascript";
$pageTitle = "JavaScript Grid";
$pageDescription = "A feature rich datagrid designed for Enterprise. Easily integrate with React to deliver filtering, grouping, aggregation, pivoting and much more.";
$pageKeyboards = "JavaScript Grid";
$pageGroup = "basics";
include '../documentation-main/documentation_header.php';
?>

<div>

    <h1>
        <img src="../images/svg/docs/getting_started.svg" width="50"/>
        <img style="vertical-align: middle" src="/images/svg/javascript.svg" height="25px"/>
        JavaScript Grid
    </h1>

    <h2>Download ag-Grid</h2>

    <p>ag-Grid is distributed as both a self contained bundle and also via a CommonJS package.</p>

    <p>As shown in the <a href="../best-javascript-data-grid">Getting Started</a> section you can reference the ag-Grid
        library
        directly via a CDN:</p>

<snippet language="html">
&lt;script src="_url_to_your_chosen_cdn_/ag-grid.js"&gt;&lt;/script&gt;
</snippet>

    <p>But you can also download the library in the following ways:</p>

    <table>
        <tr>
            <td style="padding: 10px;"><img src="../images/bower.png"/></td>
            <td>
                <b>Bower</b><br/>
                bower install ag-grid
            </td>

            <td style="width: 20px;"/>

            <td style="padding: 10px;"><img src="../images/npm.png"/></td>
            <td>
                <b>NPM</b><br/>
                <code>npm install ag-grid</code>
            </td>

            <td style="width: 20px;"/>

            <td style="padding: 10px;"><img src="../images/github.png"/></td>
            <td>
                <b>Github</b><br/>
                Download from <a href="https://github.com/ag-grid/ag-grid">Github</a>
            </td>
        </tr>
    </table>

    <p>You could then reference the ag-Grid library in a similar way to the CDN method above, but from a local
        filesystem:</p>

<snippet language="html">
&lt;script src="node_modules/ag-grid/dist/ag-grid.js"&gt;&lt;/script&gt;
</snippet>

    <p>Here we're illustrating how you can reference the ag-Grid library when using npm, but the same principle would
        apply when using bower.</p>

    <h3>ag-Grid Bundle Types</h3>
    <p>
        There are four bundle files in the distribution:
    <ul>
        <li><code>dist/ag-grid.js</code> &mdash; standard bundle containing JavaScript and CSS</li>
        <li><code>dist/ag-grid.min.js</code> &mdash; minified bundle containing JavaScript and CSS</li>
        <li><code>dist/ag-grid.noStyle.js</code> &mdash; standard bundle containing JavaScript without CSS</li>
        <li><code>dist/ag-grid.min.noStyle.js</code> &mdash; minified bundle containing JavaScript without CSS</li>
    </ul>
    </p>

    <h3>CommonJS</h3>

    <p>
        To use CommonJS, it's best to download the packages via NPM and then either <i>require</i> (ECMA 5) or
        <i>import</i> (ECMA 6)
        them into your project.
    </p>

<snippet>
// ECMA 5 - using nodes require() method
var AgGrid = require('ag-grid');

// ECMA 6 - using the system import method
import {Grid} from 'ag-grid/main';
</snippet>

    <h2>Download ag-Grid-Enterprise</h2>

    <p>As with the main ag-Grid library above, the ag-Grid-Enterprise library is also distributed as both a self
        contained bundle and also via a CommonJS package. </p>

    <p>If you're using the bundled version you only need the bundled version (i.e. <code>ag-grid-enterprise.js</code>), but
    if you're using the CommonJS package then you'll require both the <code>ag-grid</code> and <code>ag-grid-enterprise</code>
        dependency.</p>

    <p>If you're using the bundled version, you can reference the ag-Grid-Enterprise library via CDN:</p>

<snippet language=html>
&lt;script src="_url_to_your_chosen_cdn_/ag-grid-enterprise.js"&gt;&lt;/script&gt;
</snippet>

    <p>But you can also download the library in the following ways:</p>

    <table>
        <tr>
            <td style="padding: 10px;"><img src="../images/bower.png"/></td>
            <td>
                <b>Bower</b><br/>
                <code>bower install ag-grid-enterprise</code>
            </td>

            <td style="width: 20px;"/>

            <td style="padding: 10px;"><img src="../images/npm.png"/></td>
            <td>
                <b>NPM</b><br/>
                <code>npm install ag-grid-enterprise</code>
            </td>

            <td style="width: 20px;"/>

            <td style="padding: 10px;"><img src="../images/github.png"/></td>
            <td>
                <b>Github</b><br/>
                Download from <a href="https://github.com/ag-grid/ag-grid-enterprise">Github</a>
            </td>
        </tr>
    </table>

    <p>You could then reference the ag-Grid library in a similar way to the CDN method above, but from a local
        filesystem:</p>

<snippet language=html>
&lt;script src="node_modules/ag-grid/dist/ag-grid-enterprise.js"&gt;&lt;/script&gt;
</snippet>

    <h3>ag-Grid Enterprise Bundle Types</h3>

    <p>
        Again similar to ag-Grid, ag-Grid-Enterprise has 4 bundles:
    <ul>
        <li><code>dist/ag-grid-enterprise.js</code> &mdash; standard bundle containing JavaScript and CSS</li>
        <li><code>dist/ag-grid-enterprise.min.js</code> &mdash; minified bundle containing JavaScript and CSS</li>
        <li><code>dist/ag-grid-enterprise.noStyle.js</code> &mdash; standard bundle containing JavaScript without CSS</li>
        <li><code>dist/ag-grid-enterprise.min.noStyle.js </code> &mdash; minified bundle containing JavaScript without CSS</li>
    </ul>

    <h3>CommonJS</h3>
    <p>
        If using CommonJS, you one need to include ag-Grid-Enterprise into your project. You do not need to
        execute any code inside it. When ag-Grid-Enterprise loads, it will register with ag-Grid such that the
        enterprise features are available when you use ag-Grid.
    </p>

<snippet>
// ECMA 5 - using nodes require() method
var AgGrid = require('ag-grid');
// only include this line if you want to use ag-grid-enterprise
require('ag-grid-enterprise');

// ECMA 6 - using the system import method
import {Grid} from 'ag-grid/main';
// only include this line if you want to use ag-grid-enterprise
import 'ag-grid-enterprise/main';
</snippet>


    <p>The Enterprise dependency has to be made available before any Grid related component, so we suggest including it
        as soon as possible.</p>

    <h2 id="aggrid-javascript-testing">Testing ag-Grid Applications with Jasmine</h2>

    <p>In our <a href="https://github.com/ag-grid/ag-grid-seed">Javascript Seed Repo</a> we provide working
        examples of how to test your project with Jasmine (under the <code>javascript</code> project).</p>

    <p>In order to test your application you need to ensure that the Grid API is available - the best way to do this
    is to set a flag when the Grid's <code>gridReady</code> event fires, but this requires an application code change.</p>

    <p>An alternative is to use a utility function that polls until the API has been set on the <code>GridOptions</code>:</p>

    <snippet>
function waitForGridApiToBeAvailable(gridOptions, success) {
    // recursive without a terminating condition, 
    // but jasmines default test timeout will kill it (jasmine.DEFAULT_TIMEOUT_INTERVAL)
    if(gridOptions.api) {
        success()
    } else {
        setTimeout(function () {
            waitForGridApiToBeAvailable(gridOptions, success);
        }, 500);
    }
}   </snippet>

    <p>Once the API is ready, we can then invoke Grid <code>API</code> and <code>ColumnApi</code> methods:</p>

<snippet>
it('select all button selects all rows', () => {
    selectAllRows();                    // selectAllRows is a global function created in the application code 
    expect(gridOptionsUnderTest.api.getSelectedNodes().length).toEqual(3);
});
</snippet>

    <h2 id="next-steps">Next Steps...</h2>

    <p>
        Now you can go to <a href="../javascript-grid-reference-overview/">reference</a>
        to learn about accessing all the features of the grid.
    </p>

</div>

<?php include '../documentation-main/documentation_footer.php'; ?>

