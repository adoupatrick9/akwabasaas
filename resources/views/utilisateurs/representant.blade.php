@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3>
        <i class="fa fa-angle-right"></i> Les répresentants de <span class="text-uppercase">{{ $NomComplet }}</span>
        <a href="{{ url()->previous() }}" class="btn btn-danger" style="float: right">Retour <i class="fa fa-arrow-left"></i></a>
    </h3>
    <hr>
    <div class="container">
      @if(session()->has('message'))
          <h4 class="alert alert-info text-center">{{ session()->get('message') }}</h4>
      @endif
    </div>
    <a data-toggle="modal" href="{{ URL::Current().'#myModalStore' }}">
        <div class="btn btn-primary" style="margin: 10px 0px;">Ajouter un représentant  <i class="fa fa-plus"></i></div>
    </a>
    <div class="row mb" style="margin: 0px 1px;">
        <!-- page start-->
        <div class="content-panel">
            <div class="adv-table" style="margin-left: 10px; margin-right: 10px;">
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                  <thead>
                    <tr>
                        <th>Nom complet</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th class="hidden-phone">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($representants as $representant)
                      <tr>
                        <td class="text-uppercase">{{ $representant['NomComplet'] }}</td>
                        <td>{{ $representant['ap_mobile_pers'] }}</td>
                        <td>{{ $representant['ap_email_pers'] }}</td>
                        <td><a class="btn btn-outline-success btn-sm hidden-phone" href="{{ url('/representant-retirer/') }}">Retirer</a></td>
                      </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
        </div>
        <!-- page end-->
      </div>
  </section>
  @include('utilisateurs/representant-create')
@endsection

