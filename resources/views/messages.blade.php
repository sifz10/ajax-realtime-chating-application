<script type="text/javascript">
setInterval(function(){
  location.reload();
}, 1000);
</script>

@php
$messages = DB::table('messages')->get();
@endphp
{{ json_encode($messages) }}
