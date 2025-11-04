<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="{{ public_path('css/pdfglobals.css') }}" />
    <link rel="stylesheet" href="{{ public_path('css/pdfstyle.css') }}" />
  </head>
  <body>
    <div class="container">
      <div class="facturap">
        <div class="overlap">
          <div class="building-blocks"></div>
          <div class="logo">
            <img class="nuevo-logo-con" src="{{ public_path('images/pdf/nuevo-logo-con-erlenmeyer-1@2x.png') }}" />
          </div>
          <div class="encabezado">
            <div class="text-wrapper">GLOBAL COMERCIAL, S.A.</div>
            <p class="p">Calle Principal Altamira, antiguo H. Central 3c. Norte,</p>
            <p class="text-wrapper-2">Contiguo Ferretería ROMO, Oficentro Altamira</p>
            <p class="text-wrapper-3">+505 8464-2337 / +505 7651-5914 / 505 7739-1925</p>
            <img class="pasador-de-ubicacion" src="{{ public_path('images/pdf/pasador-de-ubicacion-1@2x.png') }}" />
            <img class="llamar" src="{{ public_path('images/pdf/llamar-1@2x.png') }}" />
            <div class="text-wrapper-4">ventasgloco@gmail.com</div>
            <img class="mensaje" src="{{ public_path('images/pdf/mensaje-1@2x.png') }}" />
            <div class="text-wrapper-5">RUC: J0310000286167</div>
          </div>
          <div class="factura-c-c">
            <div class="text-wrapper-6">FACTURA</div>
            <div class="checkbox-credito"></div>
            <div class="checkbox-contado"></div>
            <div class="text-wrapper-7">CONTADO</div>
            <div class="text-wrapper-8">CRÉDITO</div>
          </div>
          <div class="depa-cod-fecha">
            <div class="departamento">DEPARTAMENTO: {{ $factura->cliente->depaCliente }}</div>
            <div class="text-wrapper-9">COD.CLIENTE: {{ $factura->cliente->codigoCliente }}</div>
            <div class="text-wrapper-10">FECHA: {{ $factura->fecha }}</div>
          </div>
          <div class="info-cliente">
            <div class="overlap-group">
              <div class="text-wrapper-11">CLIENTE: {{ $factura->cliente->nombreCliente }}</div>
              <div class="text-wrapper-12">DIRECCIÓN: {{ $factura->cliente->dirCliente }}</div>
              <div class="text-wrapper-13">CONTACTO: {{ $factura->cliente->contactoCliente }}</div>
              <div class="text-wrapper-14">RUC: {{ $factura->cliente->rucCliente }}</div>
              <div class="text-wrapper-15">TELÉFONO: {{ $factura->cliente->telCliente }}</div>
            </div>
          </div>
          <div class="factura">
            <div class="overlap-2">
              <div class="rectangle"></div>
              <div class="rec-cuentas"></div>
              <img class="img" src="{{ public_path('images/pdf/nuevo-logo-con-erlenmeyer-2@2x.png') }}" />
              <img class="vector" src="{{ public_path('images/pdf/vector-1.svg') }}" />
              <div class="rectangle-2"></div>
              <p class="text-wrapper-16">NO SE ACEPTAN RECLAMOS/DEVOLUCIONES 24 HORAS DESPUÉS DE RECIBIR EL PRODUCTO</p>
              <div class="text-wrapper-17">IVA</div>
              <div class="text-wrapper-18">TOTAL</div>
              <div class="SUB-TOTAL">SUB<br />TOTAL</div>
              <img class="l-cuentas" src="{{ public_path('images/pdf/l-montoletras.svg') }}" />
              <div class="CUENTAS-BAC-u">
                CUENTAS
                BAC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;U$&nbsp;&nbsp;360870422&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C$&nbsp;&nbsp;360870372
              </div>
              <img class="l-cuentas-2" src="{{ public_path('images/pdf/l-montoletras.svg') }}" />
              <p class="cheque-a-nombre-de">
                <span class="span">Cheque a nombre de: </span>
                <span class="text-wrapper-19">GLOBAL COMERCIAL, S.A.</span>
              </p>
              <img class="l-cheque-a-nom" src="{{ public_path('images/pdf/l-montoletras.svg') }}" />
              <div class="text-wrapper-20">MONTO EN LETRAS:</div>
              <img class="l-montoletras" src="{{ public_path('images/pdf/l-montoletras.svg') }}" />

              <table class="invoice-table">
                <thead class="invoice-table-head">
                    <tr>
                        <th>CANT.</th>
                        <th>CÓDIGO</th>
                        <th>U/M</th>
                        <th>DESCRIPCIÓN</th>
                        <th>P.UNIT</th>
                        <th>IVA</th>
                        <th>SUBTOTAL</th>
                    </tr>
                </thead>
                <tbody class="invoice-table-body">
                    <tr><td colspan="7" style="height: 0px;"></td></tr> <!-- Spacing row -->
                    @foreach($factura->detalles as $detalle)
                        <tr>
                            <td>{{ $detalle->cantidad }}</td>
                            <td>{{ $detalle->inventario->codInventario }}</td>
                            <td>{{ $detalle->inventario->unidadInventario }}</td>
                            <td>{{ $detalle->inventario->descrInventario }}</td>
                            <td>${{ number_format($detalle->precioUnitario, 2) }}</td>
                            <td>${{ number_format($detalle->ivaUnitario, 2) }}</td>
                            <td>${{ number_format($detalle->cantidad * $detalle->precioUnitario, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


              <p class="text-wrapper-21">Original: Cliente / Celeste: Cliente / Rosado: Contabilidad</p>
            </div>
          </div>
        </div>
        <footer class="footer">
          <div class="overlap-group-2">
            <div class="text-wrapper-22">ELABORADO POR</div>
            <img class="l-elaborado" src="{{ public_path('images/pdf/l-sello.svg') }}" />
          </div>
          <div class="text-wrapper-23">SELLO</div>
          <div class="text-wrapper-24">VENCIMIENTO FACTURA</div>
          <img class="l-sello" src="{{ public_path('images/pdf/l-sello.svg') }}" />
          <p class="text-wrapper-25">
            IM RUC: 0012301680043B AIMP/2/0024/05-2024 10B, 50J (2) N° 5,201 - 5,700 ACF/2/5047/10-2024 OT:4204/10-2024
          </p>
        </footer>
      </div>
    </div>
  </body>
</html>
