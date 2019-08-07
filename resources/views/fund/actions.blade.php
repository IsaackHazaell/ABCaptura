<a href="{{route('fund.show', $fund_id) }}" class="btn btn-info btn-sm">
  <i class="fa fa-eye"></i></a>

<button class="btn btn-primary btn-sm"
  data-idfund="{{$fund_id}}"
  data-construction_id="{{$construction_id}}"
  data-date="{{\Carbon\Carbon::parse($fund_date)->format('Y-m-d')}}"
  data-remaining="{{ intval(str_replace(",","",$remaining))}}"
  data-total="{{intval(str_replace(",","",$total))}}"
  data-toggle="modal" data-target="#edit"><i class="fa fa-edit"></i></button>


<a id_fund="{{ $fund_id }}" class="btn btn-danger btn-sm status-fund" fund_name="{{ $name }}">
    <span class="fa fa-trash"></span>
</a>
