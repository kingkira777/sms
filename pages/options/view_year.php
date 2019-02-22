                            <div class="row">
                                <div class="col-md-8 col-sm-8">
                                    <div class="box box-primary">
                                        <div class="box-header">
                                            <h4 class="box-title">Year</h4>
                                        </div>
                                        <div class="box-body">
                                            <table id="tblYear" style="width: 100%" class="table table-condensed table-hover"></table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-4">
                                    <div class="box box-success">
                                        <div class="box-header">
                                            <h4 class="box-title"><i class="fa fa-plus"></i> ADD</h4>
                                        </div>
                                        <div class="box-body">
                                            <label>Year (from)</label>
                                            <input type="number" readonly class="form-control" min="1900" max="2099" step="1" id="year_from" />
                                            <label>Year (to)</label>
                                            <input type="number" readonly class="form-control" min="1900" max="2099" step="1" id="year_to" />
                                            <br />
                                            <button type="button" class="btn btn-primary pull-right" onclick="saveYear();">
                                                <i class="fa fa-save"></i> SAVE
                                            </button>
                                            <div class="clearfix"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>