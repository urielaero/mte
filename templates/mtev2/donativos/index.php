<div id="donativos" layout="row" layout-align="center center" ng-controller="donationCTL">
    <div class="text" flex="90">
        <p>Con tu donación, podremos seguir apoyando en la mejora del sistema educativo en México a los 600 mil usuarios que utilizan el sitio cada mes.</p>

        <br>
        
        <p>Si necesitas un recibo de tu donación, escribenos con tus datos (nombre, fecha del donativo, datos fiscales) a 
        <a class="blue" href="mailto:contacto@mejoratuescuela.org">contacto@mejoratuescuela.org</a>
        </p>
        <br>
        

        <p>MejoraTuEscuela.org es una iniciativa ciudadana, independiente y sin fines de lucro. Todas tus donaciones se utilizarán exclusivamente para el funcionamiento de la plataforma.</p>
        <br>
        

        <p>Nuestro equipo está integrado por miembros del Instituto Mexicano para la Competitividad A.C. (IMCO)
        con apoyo de la fundación Omidyar Network y US-Mexico Foundation</p>
        <br>
        

        <p>MejoraTuEscuela.org es una plataforma de todos y para todos los mexicanos. Te invitamos a que la uses y nos ayudes a difundirla.</p>
        <br>
        
        
        <p>Para más información, comunicate a los teléfonos de IMCO con el equipo de MejoraTuEscuela al (55)5985-1017 al 19.</p>
        <br>
        
        <p class="blue"><span>¡Gracias!</span></p>

        <div class="buttons" layout="row" layout-align="center center">
            <form class="donation-invisibility unique" action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                <input type="hidden" name="cmd" value="_s-xclick">
                <input type="hidden" name="hosted_button_id" value="T32FR8ZKGXYF4">
                <input type="image" src="https://www.paypalobjects.com/es_XC/i/btn/btn_donate_SM.gif" border="0" name="submit" alt="PayPal, la forma más segura y rápida de pagar en línea.">
                <img alt="" border="0" src="https://www.paypalobjects.com/es_XC/i/scr/pixel.gif" width="1" height="1">
            </form>
            <a ng-show="!loader" ng-click="toPaypal('.unique')" href="">Donativo unico</a>
            <a ng-show="!loader" href="">Donativo mensual</a>

         </div>

         <md-progress-linear ng-show="loader" md-mode="indeterminate"></md-progress-linear>

         <div class="logos" layout="row" layout-align="space-between center">
            <img flex="20" src="http://3903b795d5baf43f41af-5a4e2dc33f4d93e681c3d4c060607d64.r40.cf1.rackcdn.com/quienes_somos_imco_qs.png" alt="quienes_somos_imco_qs.png">
            <img flex="20" src="/templates/mtev2/img/logo_mejora.png" class="mte" alt="logo_mejora_tu_escuela">
            <img flex="20" src="/templates/mtev2/img/omidyar.png" alt="quienes_somos_on_qs.png">
         </div>
    </div>
</div>
