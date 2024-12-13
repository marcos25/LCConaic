<!DOCTYPE html>
@extends('admin.layout')
@section('content')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="/calendarJS/source/jsCalendar.css">
<script type="text/javascript" src="/calendarJS/source/jsCalendar.js"></script>
<script type="text/javascript" src="/calendarJS/source/jsCalendar.lang.es.js"></script>

<div >
    <title> Editar plan de acción </title>
    <h2 style="text-align:center;margin-top:20px;">Plan: {{$plan->nombre}} </h2>
    <hr>
    <center>
    <form method="POST" action="{{route('plan.update',$plan->id)}}">
       <input type='hidden' value='{{$plan->categoria_id}}' name='rec_idc'/><br>
        @csrf
        @method("put")
        <div class="form-group" {{ $errors->has('nombrePlan') ? 'has-error' : ''}}>
        <label for="exampleInputEmail1" style="font-size: 24px;">Nombre</label>
            <input type="text" style="width : 500px; heigth : 500px;" class="form-control"  name='nombrePlan' value="{{$plan->nombre}}" placeholder="Escriba el nombre para el plan de acción">
            {!! $errors->first('nombrePlan','<span class="help-block" style="color:red;">:message</span>')!!}
        </div>
        <div class="form-group" {{ $errors->has('descripcionPlan') ? 'has-error' : ''}}>
            <label for="exampleInputPassword1" style="font-size: 24px;">Descripción</label>
            <br>
            <textarea rows="4" cols="50" name='descripcionPlan'>{{$plan->descripcion}}</textarea>
            {!! $errors->first('descripcionPlan','<span class="help-block" style="color:red;">:message</span>')!!}
        </div>
        <div class="form-group" {{ $errors->has('fecha_termino') ? 'has-error' : ''}}>
            <!-- My calendar element -->
            

            <!-- Outputs -->
         
            <h4>Fecha de termino </h4>
      <input type="date" id="fecha_termino" name="fecha_termino" value="{{$plan->fecha_termino}}" ><br>

            {!! $errors->first('fecha_termino','<span class="help-block" style="color:red;">:message</span>')!!}
          <div class="form-group">
            <label for="criterioHecho" style="font-size: 24px;" name="criterioHecho">Observaciones</label>
            <p></p>
            <textarea rows="4" cols="50" name='criterioHecho'>{{$plan->criterio}}</textarea>
          </div>
        </div>

        <label for="exampleInputPassword1" style="font-size: 24px;">Plan completado</label>
            <select name="completado">
                {{-- checo si el plan esta completado o no para que el usuario pueda ver el estado del
                    select
                --}}
                @if ($plan->completado == 0)
                    <option value="0" selected>No</option>
                    <option value="1">Sí</option>
                @else 
                    <option value="0">No</option>
                    <option value="1" selected>Sí</option>
                @endif
            </select>
        
        <hr>
        <button type="submit" class="btn btn-info">
            <span class="fa fa-edit"></span>
          Editar plan de acción
        </button>
    </form> <br><br><br><br>

     <!-- Create the calendar -->
     <script type="text/javascript">
        // Create the calendar
        var calendar = jsCalendar.new("#my-calendar");
  
        
        // Get the inputs
        var print_date = document.getElementById("my-input-a");
        var print_month = document.getElementById("my-input-b");
  
        // When the user clicks on a date
        calendar.onDateClick(function(event, date){
          print_date.value = jsCalendar.tools.dateToString(date, 'DD MONTH YYYY', 'es');
          console.log(calendar._elements);
        });
  
        
        $("td").click(function() {
          //$(".jsCalendar-current").removeClass(".jsCalendar-current");
          $(".jsCalendar-current").attr('class', 'lol');
          console.log($(".jsCalendar-current"));
          $(this).addClass("jsCalendar-current");
          console.log(this);
        });
  
        
        // When a user change the month
        calendar.onMonthChange(function(event, date){
          print_month.value = jsCalendar.tools.dateToString(date, 'MONTH YYYY', 'es');
        });
      </script>
  </center>
</div>
@endsection