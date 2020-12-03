Your change is completed #{{$change_id}}.
Please use this link to view detail:
{{ env('APP_URL') . '/' . config('backpack.base.route_prefix', 'admin') . '/change2?id=' . $id }}
