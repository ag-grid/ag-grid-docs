import {Component} from "@angular/core";

import {ICellRendererAngularComp} from "ag-grid-angular";

@Component({
    selector: 'group-row-cell',
    template: `{{country}} Gold: {{gold}}, Silver: {{silver}}, Bronze: {{bronze}}`
})
export class MedalRendererComponent implements ICellRendererAngularComp {
    private params: any;
    public country: string;
    public gold: string;
    public silver: string;
    public bronze: string;

    agInit(params: any): void {
        this.params = params;
        this.country = params.node.key;
        this.gold = params.node.aggData.gold;
        this.silver = params.node.aggData.silver;
        this.bronze = params.node.aggData.bronze;
    }

    refresh(): boolean {
        return false;
    }
}