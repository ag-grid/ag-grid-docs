<?php
$key = "Testing";
$pageTitle = "ag-Grid Testing";
$pageDescription = "ag-Grid End to End (e2e) Testing";
$pageKeyboards = "ag-Grid e2e testing";
$pageGroup = "feature";
include '../documentation-main/documentation_header.php';
?>

<div>

    <h1>ag-Grid Testing</h1>

    <h2>Testing ag-Grid with Karma & Jasmine</h2>
    <p>Information on testing in a JavaScript application can be found in the <a href="../javascript-more-details#aggrid-javascript-testing">JavaScript More Details</a> section,
    while details on testing in an Angular 2.x/4.x application can be found in the <a href="../angular-more-details#aggrid-angular-testing">Angular More Details</a> section.</p>

    <h2 id="e2e-testing">End to End (e2e) Testing</h2>

    <p>
        We will walk through how you can use <code>Protractor</code> and <code>Jasmine</code> to do End to End (e2e) testing
        with ag-Grid in this section.
    </p>

    <p>These recipes below are suggestions - there are many ways to do End to End testing, what we document below is
        what we use here at ag-Grid.</p>

    <p>We do not document how to use either <code>Protractor</code> and <code>Jasmine</code> in depth here - please see either the
        <a href="http://www.protractortest.org/#/" target="_blank">Protractor</a> or
        <a href="https://jasmine.github.io/" target="_blank">Jasmine</a> for information around either of these tools.
        We only describe how these tools can be used to test ag-Grid below.</p>

    <note>End to End testing can be fragile. If you change something trivial upstream it can have a big impact on an End to End test,
    so we recommend using End to End tests in conjuction with unit tests. It's often easier to find and fix a problem at the unit
    testing stage than it is in the end to end stage.</note>

    <h3>Testing Dependencies</h3>

<snippet>
npm install protractor webdriver-manager --save-dev

// optional dependencies - if you're using TypeScript 
npm install @types/jasmine @types/selenium-webdriver --save-dev</snippet>

    <p>Note you can install <code>protractor</code> and <code>webdriver-manager</code> globally if you'd prefer,
        which would allow for shorter commands when executing either of these tools.</p>

    <p>We now need to update the webdriver:</p>

    <snippet>
./node_modules/.bin/webdriver-manager update</snippet>

    <p>This can be added to your package.json for easier packaging and repeatability:</p>

<snippet>
"scripts": {
    "postinstall": "webdriver-manager update"
}</snippet>

    <h4>Selenium Server</h4>

    <p>You can either start & stop your tests in a script, or start the Selenium server seperately, running your tests against it.</p>

    <p>Remember that the interaction between your tests and the browser is as follows:</p>

    <snippet>
[Test Scripts] &lt; ------------ &gt; [Selenium Server] &lt; ------------ &gt; [Browser Drivers]</snippet>

    <p>We'll run the server separately to begin with here:</p>

    <snippet>
./node_modules/.bin/webdriver-manager start</snippet>

    <h3>Sample Configuration</h3>

    <snippet>
// conf.js
exports.config = {
    framework: 'jasmine',
    specs: ['spec.js']
}</snippet>

    <snippet>
Here we specify the Jasmine testing framework as well as our test to run.</snippet>

    <h3>Sample Test</h3>

    <note>If you're testing against a non-Angular application then you need to tell <code>Protractor</code>
        not to wait for Angular by adding this to either your configuration or your tests: <code>browser.ignoreSynchronization = true;</code></note>

    <p>For this test we'll testing a simple JavaScript based grid which can be found at the <a
                href="../best-javascript-data-grid/example-js.html" target="_blank">Getting Started -> JavaScript</a> Section:</p>

    <img src="../images/example-js.png" style="width: 100%;padding-bottom: 10px">

    <h4>Checking Headers</h4>

    <p>Let's start off by checking the headers are the ones we're expecting. We can do this by retrieving all <code>div</code>'s that
        have the <code>ag-header-cell-text</code> class:
    </p>

<snippet>
// spec.js
describe('ag-Grid Protractor Test', function () {
    // not an angular application
    browser.ignoreSynchronization = true;

    beforeEach(() =&gt; {
        browser.get("https://www.ag-grid.com/best-javascript-data-grid/example-js.html");
    });

    it('should have expected column headers', () =&gt; {
        element.all(by.css(".ag-header-cell-text"))
            .map(function (header) {
                return header.getText()
            }).then(function (headers) {
                expect(headers).toEqual(['Make', 'Model', 'Price']);
            });
    });
});</snippet>

    <p>We can now run our test by executing the following command:</p>

<snippet>
./node_modules/.bin/protractor conf.js

// or if protractor is installed globally
protractor conf.js</snippet>

    <h4>Checking Grid Data</h4>

    <p>We can match grid data by looking for rows by matching <code>div[row="&lt;row id&gt;"]</code> and then column
        values within these rows by looking for <code>div</code>'s with a class of <code>.ag-cell-value</code>:</p>

<snippet>
it('first row should have expected grid data', () =&gt; {
    element.all(by.css('div[row="0"] div.ag-cell-value'))
        .map(function (cell) {
            return cell.getText();
        })
        .then(function (cellValues) {
            expect(cellValues).toEqual(["Toyota", "Celica", "35000"]);
        });
});</snippet>

    <p>We can add this to <code>spec.js</code> and run the tests as before.</p>


    <h3>ag-Grid Testing Utilities</h3>
    
    <note>These utilities scripts should still be considered beta and are subject to change. Please provide feedback to 
    the <a href="https://github.com/seanlandsman/ag-grid-testing" target="_blank">GitHub</a> repository.</note>

    <p>Here at ag-Grid we use a number of utility functions that make it easier for us to test ag-Grid functionality.</p>

    <p>The utilities can be installed & imported as follows:</p>

    <p>Installing:</p>
<snippet>
npm install ag-grid-testing --save-dev</snippet>

    <p>Importing:</p>

    <snippet>
let ag_grid_utils = require("ag-grid-testing");
   </snippet>

    <h4>verifyRowDataMatchesGridData</h4>

    <p>Compares Grid data to provided data. The order of the data provided should correspond to the order within the grid.
    The property names should correspond to the <code>colId</code>'s of the columns.</p>

    <snippet>
ag_grid_utils.verifyRowDataMatchesGridData(
    [
        // first row
        {
            "name": "Amelia Braxton",
            "proficiency": "42%",
            "country": "Germany",
            "mobile": "+960 018 686 075",
            "landline": "+743 1027 698 318"
        },
        // more rows...
    ]
);
   </snippet>

    <h4>verifyCellContentAttributesContains</h4>
    <p>Userful when there is an array of data within a cell, each of which is witing an attribute (for example an image).</p>

    <snippet>
ag_grid_utils.verifyCellContentAttributesContains(1, "3", "src", ['android', 'mac', 'css'], "img");</snippet>

    <h4>allElementsTextMatch</h4>

    <p>Verifies that all elements text (ie the cell value) matches the provided data. Usf</p>

    <snippet>
ag_grid_utils.allElementsTextMatch(by.css(".ag-header-cell-text"),
    ['#', 'Name', 'Country', 'Skills', 'Proficiency', 'Mobile', 'Land-line']
);
   </snippet>

    <h4>clickOnHeader</h4>

    <p>Clicks on a header with the provided <code>headerName</code>.</p>
    <snippet>
ag_grid_utils.clickOnHeader("Name");</snippet>

    <h4>getLocatorForCell</h4>

    <p>Provides a CSS <code>Locator</code> for a grid cell, by row & id and optionally a further CSS selector.</p>

    <snippet>
ag_grid_utils.getLocatorForCell(0, "make")
ag_grid_utils.getLocatorForCell(0, "make", "div.myClass)</snippet>

    <h4>getCellContentsAsText</h4>

    <p>Returns the cell value (as text) for by row & id and optionally a further CSS selector.</p>

<snippet>
ag_grid_utils.getCellContentsAsText(0, "make")
             .then(function(cellValue) {
                // do something with cellValue
             });

ag_grid_utils.getCellContentsAsText(0, "make", "div.myClass)
             .then(function(cellValue) {
                // do something with cellValue
             });</snippet>
</div>

<?php include '../documentation-main/documentation_footer.php';?>
