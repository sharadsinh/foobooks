@extends('layouts.master')

@section('title')
  Create book entry
@stop

@section('content')
  <form>
    Book Name: <input type="text" name="bookname">
    <br>
    Author Name: <input type="text" name="authorname">
    <br><br>
    <input type="submit" value="Submit">
  </form>
@stop
