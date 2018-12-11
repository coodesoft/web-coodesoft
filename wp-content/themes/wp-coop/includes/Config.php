<?php
function WpcGetSectionsSiglePost(){
    return [
      ['type_class' => WpcSectionSinglePost],
      ['type_class' => WpcSectionMenu, 'container' => '','class' => '',
        'menu_options' => [
          'id'    => 'Main',
          'brand' => [
            'url'      => get_option('home'),
            'content'  => '',
          ],
          'btn_align' => 'left',
          'estate'    => 'collapse',
          'class'     => 'navbar-inverse bg-inverse fixed-top',
        ],
      ],
    ];
}

function WpcGetSectionsIndexInfo(){
return [
  [   'type_class' => WpcSectionPage, 'id' => 'inicio', 'page_id' => 22//WpcColsContainer,
  //  'container' => 'section',
  /*  'content' => [
      ['type_class' => WpcSectionPage,     'container' => 'div','class' => 'col-xs-4'],
      ['type_class' => WpcWidgetContainer, 'container' => 'div','class' => 'col-xs-4',
        'widget_data' => [
          'name'          => esc_html__( 'Zona central', 'wordcampguide2017' ),
          'id'            => 'sidebar-1',
          'description'   => esc_html__( 'Add widgets here.', 'wordcampguide2017' ),
          'before_widget' => '<section id="%1$s" class="widget %2$s">',
          'after_widget'  => '</section>',
          'before_title'  => '<h2 class="widget-title">',
          'after_title'   => '</h2>',
        ],
      ],
    ],*/
  ],
  [ 'type_class' => WpcSectionMenu,
    'menu_options' => [
      'id'    => 'Main',
      'brand' => [
        'url'      => get_option('home'),
        'content'  => '',
      ],
      'btn_align' => 'left',
      'estate'    => 'collapse',
      'class'     => 'navbar-inverse fixed-top',
    ],
  ],
  [   'type_class' => WpcSectionPage,
      'id' => 'nosotros',
      'content_element_attr' => ['tag' => 'div', 'class'=>'container'],
      'page_id' => 19
  ],
  [   'type_class' => WpcSectionPodsGrid,
      'id'                   => 'equipo',
      'posts_p_fila'         => 2,
      'class'                => 'col equipo',
      'content_element_attr' => ['tag' => 'div', 'class'=>'container'],
      'pods'                 => [
         'id'     => 'perfil',
         'campos' => [
           ['id' => 'foto',       'type_class' => WpcPodsFieldImg , ],
           ['id' => 'name',       'type_class' => WpcPodsFieldText, 'tag' => 'h4'],
           ['id' => 'linkedin',   'type_class' => WpcPodsFieldLink, ],
           ['id' => 'email',      'type_class' => WpcPodsFieldLink, ],
           ['id' => 'freelancer', 'type_class' => WpcPodsFieldLink, ],
         ],
      ],

      'beforeToContent' => [
        'type_class' => WpcSectionTitle,
        'title'      => 'EQUIPO',
        'subTitle'   => '¿Quienes somos a fin de cuentas?',
        'class'      => 'col text-center',
      ],
  ],
  [   'type_class' => WpcSectionPodsGrid,
      'content_element_attr' => ['tag' => 'div', 'class'=>'container'],
      'id'       => 'servicios',
      'pods'     => ['id'=>'servicio'],
  ],
  [   'type_class' => WpcSectionPodsGrid,
      'id' => 'porfolio',
      'content_element_attr' => ['tag' => 'div', 'class'=>'container'],
      'pods'     => ['id'=>'porfolio'],
  ],
  [   'type_class' => WpcSectionPosts,
      'id' => 'noticias',
      'category' => 'Noticias',
      'posts_p_fila' => 2,
      'content_element_attr' => ['tag' => 'div', 'class'=>'container'],
  ],
  [   'type_class' => WpcSectionPage,
      'id' => 'contacto',
      'page_id' => 24
  ],
];
}
 ?>
