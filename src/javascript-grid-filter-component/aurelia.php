<p>
    <!-- start of aurelia -->
    <h2 id="aureliaFiltering">
        <img src="../images/aurelia.png" style="width: 60px"/>
        Aurelia Filtering
    </h2>

    <div class="note" style="margin-bottom: 20px">
        <img align="left" src="../images/note.png" style="margin-right: 10px;" />
        <p>This section explains how to create an ag-Grid Filter using Aurelia. You should read about how
            <a href="../javascript-grid-filter-component/">Filters Components</a> work in ag-Grid first before trying to
            understand this section.</p>
    </div>

    <p>
        All of the information above is relevant to Aurelia filters - this section explains how to apply this logic to your Aurelia component.
    </p>

    <p>
        For an example on Aurelia filtering, see the
        <a href="https://github.com/ag-grid/ag-grid-aurelia-example">ag-grid-aurelia-example</a> on Github.</p>
    </p>

    <h3 id="specifying-a-filter-in-an-aurelia-project"><img src="../images/aurelia_large.png" style="width: 20px;"/> Specifying a Filter in an Aurelia project</h3>

    <p>
        If you are using the ag-grid-aurelia component to create the ag-Grid instance,
        then you will have the option of additionally specifying the filters
        as Aurelia components.
    </p>

    <snippet>
// create your filter as Filter Component
export default class PartialMatchFilter implements IFilter {
  private params: IFilterParams;
  private valueGetter: (rowNode: RowNode) =&gt; any;
  private filterText: any;
  private eGui: HTMLElement;
  private eFilterText: any;

  public init(params: IFilterParams): void {
    this.params = params;
    this.filterText = null;
    this.valueGetter = params.valueGetter;
  };

  public getGui() {
    this.eGui = document.createElement('div');
    this.eGui.innerHTML =
      '&lt;input style="margin: 4px 0px 4px 0px;" type="text" id="filterText" placeholder="Full name search..."/&gt;';

    this.eFilterText = this.eGui.querySelector('#filterText');
    this.eFilterText.addEventListener("changed", listener);
    this.eFilterText.addEventListener("paste", listener);
    this.eFilterText.addEventListener("input", listener);
    // IE doesn't fire changed for special keys (eg delete, backspace), so need to
    // listen for this further ones
    this.eFilterText.addEventListener("keydown", listener);
    this.eFilterText.addEventListener("keyup", listener);

    var that = this;

    function listener(event) {
      that.filterText = event.target.value;
      that.params.filterChangedCallback();
    }

    return this.eGui;
  };

  isFilterActive(): boolean {
    return this.filterText !== null && this.filterText !== undefined && this.filterText !== '';
  }

  doesFilterPass(params: IDoesFilterPassParams): boolean {
    // make sure each word passes separately, ie search for firstname, lastname
    let passed = true;
    this.filterText.toLowerCase().split(" ").forEach((filterWord) =&gt; {
      let value = this.valueGetter(&lt;any&gt;params);
      if (value.toString().toLowerCase().indexOf(filterWord) &lt; 0) {
        passed = false;
      }
    });
    return passed;
  }

  getModel(): any {
    var model = {value: this.filterText.value};
    return model;
  }

  setModel(model: any): void {
    this.eFilterText.value = model.value;
  }

  afterGuiAttached(params: IAfterFilterGuiAttachedParams): void {
    this.eGui.focus();
  }
}

// provide a method that returns the name of the class to use as a filter (in the parent component)
getPartialMatchFilter() {
    return PartialMatchFilter;
}

// then reference the Component in your column definitions like this
&lt;ag-grid-column header-name="Filter Component" field="name" width.bind="198" filter.bind="getPartialMatchFilter()"&gt;&lt;/ag-grid-column&gt;</snippet>

