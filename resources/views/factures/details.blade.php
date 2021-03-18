@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3>
        <i class="fa fa-angle-right"></i> Détails facture</span>
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
                        <th>Service</th>
                        <th>Coût service</th>
                        <th>Prix unitaire</th>
                        <th>Quantité</th>
                        <th>Prix total HT</th>
                        <th>Prix total TTC</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($detailsFactures as $detailsFacture)
                      <tr>
                        <td class="text-uppercase">
                            {{ $detailsFacture['sce_nom_service'] }}
                            @switch($detailsFacture['sce_type_service'] )
                                @case(1)
                                    (Saas)
                                    @break
                                @case(2)
                                    (One premise)
                                    @break
                            @endswitch
                        </td>
                        <td>{{ $detailsFacture['df_cout_service'] }}</td>
                        <td>{{ $detailsFacture['df_prix_unitaire'] }}</td>
                        <td>{{ $detailsFacture['df_quantite'] }}</td>
                        <td>{{ $detailsFacture['df_prix_total_HT'] }}</td>
                        <td>{{ $detailsFacture['df_prix_total_TTC'] }}</td>
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
