@extends(backpack_view('blank'))

@php
    $total = (new \Framework\Models\Change())->count();

    $draft = (new \Framework\Models\Change())->where('status_id', 1)->count();
    $open = (new \Framework\Models\Change())->where('status_id', 2)->count();
    $approval = (new \Framework\Models\Change())->where('status_id', 3)->count();
    $rejected = (new \Framework\Models\Change())->where('status_id', 6)->count();
    $inprogress = (new \Framework\Models\Change())->where('status_id', 4)->count();
    $closed = (new \Framework\Models\Change())->where('status_id', 5)->count();

    // $widgets['before_content'][] = [
    //     'type'        => 'jumbotron',
    //     'heading'     => trans('backpack::base.welcome'),
    //     'content'     => trans('backpack::base.use_sidebar'),
    //     'button_link' => backpack_url('logout'),
    //     'button_text' => trans('backpack::base.logout'),
    // ];

    // notice we use Widget::add() to add widgets to a certain group
	Widget::add()->to('before_content')->type('div')->class('row')->content([
		// notice we use Widget::make() to add widgets as content (not in a group)
		Widget::make()
			->type('progress_white')
			->class('card cursor-pointer change-status-2')
			->progressClass('progress-bar bg-primary')
			->value($open)
			->description('Open')
			->progress(100 * $open / $total)
            ->hint('Changes\'s status is Open.'),

        Widget::make()
			->type('progress')
			->class('card border-0 text-white bg-primary cursor-pointer change-status-3')
			->progressClass('progress-bar')
			->value($approval)
			->description('Waiting for Approval')
            ->progress(100 * $approval / $total)
            ->hint('Changes\'s status is Waiting for Approval.'),

        Widget::make()
			->type('progress_white')
			->class('card cursor-pointer change-status-4')
			->progressClass('progress-bar bg-success')
			->value($inprogress)
			->description('In-progress')
            ->progress(100 * $inprogress / $total)
            ->hint('Changes\'s status is In-progress.'),

        Widget::make()
			->type('progress')
			->class('card text-white bg-success cursor-pointer change-status-5')
			->progressClass('progress-bar')
			->value($closed)
			->description('Closed')
            ->progress(100 * $closed / $total)
            ->hint('Changes\'s status is Closed.'),

        Widget::make()
			->type('progress_white')
			->class('card cursor-pointer change-status-1')
			->progressClass('progress-bar bg-warning ')
			->value($draft)
			->description('Draft / Returned')
            ->progress(100 * $draft / $total)
            ->hint('Changes\'s status is Draft / Returned.'),

        Widget::make()
			->type('progress')
			->class('card text-white bg-danger cursor-pointer change-status-6')
			->progressClass('progress-bar')
			->value($rejected)
			->description('Rejected')
            ->progress(100 * $rejected / $total)
            ->hint('Changes\'s status is Rejected.'),

    ]);
@endphp

@section('content')
  {{-- <p>Your custom HTML can live here</p> --}}
@endsection

@push('after_styles')
  <style>
    .cursor-pointer {
        cursor: pointer;
    }
  </style>
@endpush

@push('after_scripts')
  <script>
      jQuery(document).ready(function($) {
          // trigger select2 for each untriggered select2 box
          $('.change-status-2').on('click', function() {
            window.location.href = baseRoute + "/change?status=2";
          });
          $('.change-status-3').on('click', function() {
            window.location.href = baseRoute + "/change?status=3";
          });
          $('.change-status-6').on('click', function() {
            window.location.href = baseRoute + "/change?status=6";
          });
          $('.change-status-1').on('click', function() {
            window.location.href = baseRoute + "/change?status=1";
          });
          $('.change-status-4').on('click', function() {
            window.location.href = baseRoute + "/change?status=4";
          });
          $('.change-status-5').on('click', function() {
            window.location.href = baseRoute + "/change?status=5";
          });
      });
  </script>
@endpush
