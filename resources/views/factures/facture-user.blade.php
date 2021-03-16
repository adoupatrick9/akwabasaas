@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3>
        <i class="fa fa-angle-right"></i> Les factures <span class="text-uppercase">{{ $proprietaireFacture['NomComplet'] }}</span>
        <a href="{{ url()->previous() }}" class="btn btn-danger" style="float: right">Retour <i class="fa fa-arrow-left"></i></a>
    </h3>
    <hr>
    <div class="row mb" style="margin: 0px 1px;">
        <!-- page start-->
        <div class="content-panel">
            <div class="adv-table" style="margin-left: 10px; margin-right: 10px;">
                <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                  <thead>
                    <tr>
                        <th>Numero facture</th>
                        <th>Montant total</th>
                        <th>Payé</th>
                        <th class="hidden-phone">Date de facturation</th>
                        <th class="hidden-phone">Date d'échéance</th>
                        <th class="hidden-phone">Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($factures as $facture)
                      <tr>
                        <td style="vertical-align: middle;">{{ $facture['Numero_facture'] }}</td>
                        <td style="vertical-align: middle;">{{ $facture['Fac_montant'] }}</td>
                        <td style="vertical-align: middle;" class="center">
                            @if($facture['Fac_paye'] == true)
                                <img src="{{ asset('img/ok.png') }}" alt="ok" width="25" height="25">
                            @endif
                        </td>
                        <td style="vertical-align: middle;">{{ $facture['Fac_date_facturation'] }}</td>
                        <td style="vertical-align: middle;">{{ $facture['Fac_date_echeance'] }}</td>
                        <td style="vertical-align: middle;" class="center">
                            @if($facture['Fac_paye'] == true)
                                <img src="{{ asset('img/ok.png') }}" alt="ok" width="25" height="25">
                            @endif
                        </td>
                        <td class="center hidden-phone">
                                <!-- Split button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-theme03">Actions</button>
                                <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/facture-voir/'.$facture['IDas_facture']) }}">Voir</a></li>
                                </ul>
                            </div>
                        </td>
                      </tr>
                    @endforeach

                  </tbody>
                </table>
              </div>
        </div>
        <!-- page end-->
      </div>
  </section>
@endsection

