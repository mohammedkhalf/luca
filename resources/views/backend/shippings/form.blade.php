<div class="box-body">
    <div class="form-group">
        {{ Form::label('region', trans('labels.backend.shippings.table.region'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('region', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.shippings.table.region'), 'required' => 'required','readonly' => 'true']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        {{ Form::label('area', trans('labels.backend.shippings.table.area'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('area', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.shippings.table.area'), 'required' => 'required' , 'readonly' => 'true']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        {{ Form::label('region_en', trans('labels.backend.shippings.table.region_en'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('region_en', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.shippings.table.region_en'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        {{ Form::label('area_en', trans('labels.backend.shippings.table.area_en'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('area_en', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.shippings.table.area_en'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->
    <div class="form-group">
        {{ Form::label('shipping_company', trans('labels.backend.shippings.table.shipping_company'), ['class' => 'col-lg-2 control-label required']) }}
        <div class="col-lg-10">
            {{ Form::text('shipping_company', null, ['class' => 'form-control box-size', 'placeholder' => trans('labels.backend.shippings.table.shipping_company'), 'required' => 'required']) }}
        </div><!--col-lg-10-->
    </div><!--form-group-->
</div><!--box-body-->

@section("after-scripts")
    <script type="text/javascript">
        //Put your javascript needs in here.
        //Don't forget to put `@`parent exactly after `@`section("after-scripts"),
        //if your create or edit blade contains javascript of its own
        $( document ).ready( function() {
            //Everything in here would execute after the DOM is ready to manipulated.
        });
    </script>
@endsection
