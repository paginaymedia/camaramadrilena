<?php
$mobilemenu = array(
    'menu' => 'principal',
    'container' => 'nav',
    'container_class' => 'collapse navbar-collapse',
    'container_id' => 'navbarResponsive',
    'menu_class' => 'navbar-nav ml-auto',
    'menu_id' => '',
    'echo' => true,
    'fallback_cb' => 'wp_page_menu',
    'before' => '',
    'after' => '',
    'link_before' => '',
    'link_after' => '',
    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'item_spacing' => 'preserve',
    'depth' => 0,
    'walker' => '',
    'theme_location' => '',
);
$footermenu = array(
    'menu' => 'footer',
    'container' => 'nav',
    'container_class' => 'collapse navbar-collapse',
    'container_id' => 'navbarResponsive',
    'menu_class' => 'navbar-nav ml-auto',
    'menu_id' => '',
    'echo' => true,
    'fallback_cb' => 'wp_page_menu',
    'before' => '',
    'after' => '',
    'link_before' => '',
    'link_after' => '',
    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'item_spacing' => 'preserve',
    'depth' => 0,
    'walker' => '',
    'theme_location' => '',
);
?>
<footer>
    <div class="container">
        <div class="row">
            <div class="col s12 right-align"><a href="https://www.linkedin.com/company/34712039" class="linkedinarchor" target="_blank" rel="nofollow"><img src="//camaramadrilena.org/wp-content/themes/camara/assets/images/linkedin.png" alt="linked in"/></a></div>
        </div>
        <div class="row">
            <div class="col s12 right-align"><?php wp_nav_menu($footermenu); ?></div>
        </div>
    </div>
    <div class="container" style="text-align: center">
    <img src="http://www.camaramadrilena.org/wp-content/uploads/footer.png" />
</div>
</footer>
<ul id="slide-out" class="sidenav">
    <?php wp_nav_menu($mobilemenu); ?>
</ul>
<div class="modal">
    <div class="modal-content">
        <form id="presupuestoform">
            <div class="row">
                <div class="col s12">
                    <h3>Solicitar presupuesto</h3>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <input type="text" id="presupuestoNombre" name="nombre" value="" placeholder="Nombre" />
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <input type="text" id="presupuestoTelefono" name="telefono" value="" placeholder="Teléfono" />
                </div>
                <div class="col s6">
                    <input type="text" id="presupuestoEmail" name="email" value="" placeholder="Email" />
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <input type="text" id="presupuestoDireccion" name="direccion" value="" placeholder="Dirección" />
                </div>
            </div>
            <div class="row">
                <div class="col s8">
                    <input type="text" id="presupuestoEmpleados" name="empleados" value="" placeholder="Empleados" />
                </div>
                <div class="col s4">
                    Piscina<br>
                    <label>
                        <input name="piscina" value="si" type="radio" />
                        <span>Si</span>
                    </label>
                    <label>
                        <input name="piscina" value="no" type="radio" />
                        <span>No</span>
                    </label>

                </div>

            </div>
            <div class="row">
                <div class="col s4">
                    <input type="text" id="presupuestoNViviendas" name="nViviendas" value="" placeholder="Nº de viviendas" />
                </div>
                <div class="col s4">
                    <input type="text" id="presupuestoNGarajes" name="nGarajes" value="" placeholder="Nº de garajes" />
                </div>
                <div class="col s4">
                    <input type="text" id="presupuestoNlocales" name="nViviendas" value="" placeholder="Nº de locales" />
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <input type="text" id="presupuestoComentarios" name="comentarios" value="" placeholder="Comentarios" />
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <div class="botonpresupuesto"><a class="btn waves-effect btn-large botonpresupuesto">Solicitar presupuesto</a></div>
                </div>
            </div>

        </form>
    </div>
</div>

<div id="cta">
    <div class="row">
        <div class="col s4 botonllamar">
            <a class="btn waves-effect btn-large botonllamar" href="tel:914565202"><i class="fas fa-phone-alt"></i> Llamar</a>
        </div>
        <div class="col s8 botonpresupuesto">
            <a class="btn waves-effect btn-large botonpresupuesto" href="#">Solicitar presupuesto</a>
        </div>

    </div> 
</div>
<?php wp_footer(); ?>
</body>
</html>
