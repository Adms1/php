@php
    $count = 0;
@endphp
@if (isset($test_sections))
@foreach ($test_sections as $section)
<div class="panel panel-default border-panel mb-0 box-shadow">
    <div id="" class="panel-heading panel-head">
        <div class="">
            <label class="control-label">{{ $section['SectionName'] }}</label>
        </div>
        @if (isset($section['secQueType']))
        @foreach($section['secQueType'] as $questionType)
        <div class="col-lg-6 col-md-6 col-sm-12 pa-0">
            {{$questionType['questionTypeName']}}
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 text-right float-right">
            (Total Questions : <span>{{$questionType['NumberofQuestion']}}</span>
            | Total Marks :<span>{{$questionType['NumberofQuestion'] * $questionType['QuestionMarks']}}</span>)
        </div>
        <div class="clearfix"></div>
        <div>
            @if (isset($questionType['Que']))
            <table class="table table-striped table-bordered dt-responsive nowrap jambo_table bulk_action">
            @foreach($questionType['Que'] as $question)
                <tr>
                    <td style="width: 10%"> {!! 'Q.'.++$count !!} </td>
                    <td style="width: 70%">
                        @if ($question['QuestionImage'])
                        <img src="{{ Config::get('settings.QUESTION_IMAGE_URL').$question['QuestionImage'] }}"/>
                        @else
                        {!! $question['QuestionText'] !!} 
                        @endif
                        @if (isset($question['Options'])) 
                        <div>
                            <table>
                                @php
                                    $a = 'A';
                                @endphp
                                @foreach($question['Options'] as $option)
                                <tr>
                                    <td>{{'( '.$a++. ' ) '}}</td>
                                    <td>
                                    @if ($option->AnswerImage) 
                                    <img src="{{ Config::get('settings.QUESTION_IMAGE_URL').$option->AnswerImage }}"/>
                                    @else
                                    {{$option->MCQAText}}
                                    @endif
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        @endif
                    </td>
                    <td style="width: 10%"> {!! $questionType['QuestionMarks'] !!} </td>
                </tr>
            @endforeach
            </table>
            @endif
        </div>
        @endforeach
        @endif
    </div>
</div>
@endforeach
@endif