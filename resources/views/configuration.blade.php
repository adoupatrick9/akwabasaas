@extends('layouts.theme')

@section('content')

        <section class="wrapper">
          <h3><i class="fa fa-angle-right"></i> Configurations</h3>
          <div class="container">
                @if(session()->has('message'))
                    <h4 class="alert alert-info text-center">{{ session()->get('message') }}</h4>
                @endif
            </div>
          <div class="row mt">
            <div class="col-lg-6">
              <div class="content-panel">
                <h4><i class="fa fa-angle-right"></i> Liste des devises</h4>

                <section id="unseen" style="margin-left: 10px; margin-right: 10px;">
                    <hr>
                    <a data-toggle="modal" href="{{ url('/configurations#myModalStoreDevise') }}">
                        <div class="btn btn-primary" style="margin-bottom: 10px;">Ajouter une devise  <i class="fa fa-plus"></i></div>
                    </a>
                  <table class="table table-bordered table-striped table-condensed" >
                    <thead>
                      <tr>
                        <th width="20%">Devise</th>
                        <th width="10%">Actions</th>
                      </tr>
                    </thead>
                    <tbody id="ajoutDevise">
                        @foreach($devises as $devise)
                            <tr>
                                <td class="text-uppercase">{{ $devise['Dev_intitule_devise'] }}</td>
                                <td class="center">
                                    <!-- Split button -->
                                <div class="btn-group">
                                    <button type="button" class="btn btn-theme03">Actions</button>
                                    <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li id="modifier"><a href="{{ url('/devises-edit/'.$devise['IDas_devise'].'/configurations') }}" >Modifier</a></li>
                                        <li  id="supprimer"><a href="{{ url('/devises-delete/'.$devise['IDas_devise']) }}">Supprimer</a></li>
                                    </ul>
                                </div>
                              </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </section>
              </div>
              <!-- /content-panel -->
            </div>
        </section>

        @include('devises.create')

@endsection

