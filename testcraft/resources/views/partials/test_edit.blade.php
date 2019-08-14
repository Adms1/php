{!! Form::open(['method' => 'PUT', 'id' => 'testForm', 'route' => ['test_update', $test->TestPackageTestID], 'enctype' => 'multipart/form-data', 'data-parsley-validate']) !!}
{!! Form::hidden('TestPackageID', $test->TestPackageID, ['class' => 'form-control', 'id' => 'package_id', 'placeholder' => '', 'required' => '']) !!}
<div class="row">
    <div class="col-xs-12 form-group">
        {!! Form::label('TestName', trans('admin.tests.fields.name').'*', ['class' => 'control-label']) !!}
        {!! Form::text('TestName', $test->TestName, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

        @if($errors->has('TestName'))
            <p class="help-block">
                {{ $errors->first('TestName') }}
            </p>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-xs-6 form-group">
        {!! Form::label('TestDuration', trans('admin.tests.fields.duration').'*', ['class' => 'control-label']) !!}
        {!! Form::text('TestDuration', $test->TestDuration, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

        @if($errors->has('TestDuration'))
            <p class="help-block">
                {{ $errors->first('TestDuration') }}
            </p>
        @endif
    </div>
    <div class="col-xs-6 form-group">
        {!! Form::label('DifficultyLevelID', trans('admin.tests.fields.difficulty-level').'*', ['class' => 'control-label']) !!}
        {!! Form::select('DifficultyLevelID', $dif_levels, $test->DifficultyLevelID,['class' => 'form-control', 'placeholder' => 'Please Select Difficulty Level', 'required' => '']) !!}

        @if($errors->has('DifficultyLevelID'))
            <p class="help-block">
                {{ $errors->first('DifficultyLevelID') }}
            </p>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-xs-6 form-group">
        {!! Form::label('NumberofQuestion', trans('admin.tests.fields.question').'*', ['class' => 'control-label']) !!}
        {!! Form::text('NumberofQuestion', $test->NumberofQuestion, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

        @if($errors->has('NumberofQuestion'))
            <p class="help-block">
                {{ $errors->first('NumberofQuestion') }}
            </p>
        @endif
    </div>
    <div class="col-xs-6 form-group">
        {!! Form::label('TestMarks', trans('admin.tests.fields.marks').'*', ['class' => 'control-label']) !!}
        {!! Form::text('TestMarks', $test->TestMarks, ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}

        @if($errors->has('TestMarks'))
            <p class="help-block">
                {{ $errors->first('TestMarks') }}
            </p>
        @endif
    </div>
</div>
{!! Form::submit(trans('admin.ca_submit'), ['class' => 'btn btn-success', 'style' => 'float:right']) !!}
{!! Form::close() !!}