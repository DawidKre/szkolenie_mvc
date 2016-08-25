import {Component, Input, Output, EventEmitter, OnInit} from "@angular/core";
import {NgModel, NgIf, NgFor, NgClass, FORM_DIRECTIVES, ControlValueAccessor} from "@angular/common";

@Component({
    selector: 'ng-pagination[ngModel]',
    directives: [FORM_DIRECTIVES, NgIf, NgFor, NgClass],
    templateUrl: 'app/directives/pagination.directive.html'
})
export class PaginationDirective implements ControlValueAccessor, OnInit {
    @Input("first-text") firstText:string;
    @Input("last-text") lastText:string;
    @Input("totalItems") totalItems:number;
    @Input("currentPage") cPage:number;
    @Input("maxSize") pageSize:number;
    @Output("pageChanged") pageChanged = new EventEmitter();
    currentpage:number;
    pageList:Array<number> = [];
    private onChange:Function;
    private onTouched:Function;
    private seletedPage:number;
    private totalSize:number;

    constructor(private pageChangedNgModel:NgModel) {
        this.pageChangedNgModel.valueAccessor = this;

    }

    private t1(val, min, max) {
        return (val >= min && val <= max);
    }

    ngOnInit() {
        this.doPaging();
    }

    doPaging() {
        this.pageList = [];
        this.seletedPage = this.currentpage;
        var remaining = this.totalItems % this.pageSize

        this.totalSize = ((this.totalItems - remaining) / this.pageSize) + (remaining === 0 ? 0 : 1);

        for (var i = 0, cnt = 1; i < this.totalSize; i++, cnt++) {
            if (this.t1(cnt, (this.currentpage - 3), (this.currentpage + 3))) {
                this.pageList.push(cnt);
            }
        }
    }

    setCurrentPage(pageNo) {
        this.currentpage = pageNo;
        this.pageChangedNgModel.viewToModelUpdate(pageNo);
        this.pageChageListner();
        this.doPaging()
        this.seletedPage = pageNo;
    }

    firstPage() {
        this.currentpage = 1;
        this.pageChangedNgModel.viewToModelUpdate(1);
        this.pageChageListner();
        this.doPaging()
    }

    lastPage() {
        this.currentpage = this.totalSize;
        this.pageChangedNgModel.viewToModelUpdate(this.totalSize);
        this.pageChageListner();
        this.doPaging()
    }

    writeValue(value:string):void {
        console.info('writeValue');
        if (!value) return;
        this.setValue(value);
    }

    registerOnChange(fn:(_:any) => {}):void {
        console.info('registerOnChange');
        this.onChange = fn;
    }

    registerOnTouched(fn:(_:any) => {}):void {
        console.info('registerOnTouched');
        this.onTouched = fn;
    }

    setValue(currentValue) {
        this.currentpage = currentValue;
    }

    pageChageListner() {
        this.pageChanged.emit({
            itemsPerPage: this.currentpage
        })
    }
}