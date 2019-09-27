<span>
	@if($question->QuestionImage)
		<img src="{{ Config::get('settings.QUESTION_IMAGE_URL').$question->QuestionImage }}"/>
	@else
		{!! $question->QuestionText !!}
	@endif
</span>
