class Select2Modal {
    constructor(modalId, selectId, ajaxUrl) {
      this.modalId = modalId;
      this.selectId = selectId;
      this.ajaxUrl = ajaxUrl;
      this.initialize();
    }
  
    initialize() {
      $(document).ready(() => {
        $(this.modalId).on('show.bs.modal', () => {
          this.initSelect2();
        });
  
        $(this.modalId).on('hidden.bs.modal', () => {
          this.resetSelect2();
        });
      });
    }
  
    initSelect2() {
      // Inicializar select2 con el tema de Bootstrap
      $(this.selectId).select2({
        theme: 'bootstrap', // Aplicar el tema de Bootstrap
        ajax: {
          url: this.ajaxUrl,
          dataType: 'json',
          delay: 250,
          data: function (params) {
            return {
              q: params.term, // término de búsqueda
              page: params.page || 1
            };
          },
          processResults: function (data, params) {
            // Verifica si los datos están definidos y son válidos
            if (!data || !data.items) {
              console.error('Datos inválidos recibidos:', data);
              return {
                results: [],
                pagination: {
                  more: false
                }
              };
            }
            // parsea los resultados en el formato que select2 espera
            params.page = params.page || 1;
            return {
              results: data.items, // ajusta según la estructura de tus datos
              pagination: {
                more: (params.page * 30) < data.total_count
              }
            };
          },
          cache: true
        },
        placeholder: 'Seleccione una opción',
        minimumInputLength: 1,
        language: {
          inputTooShort: function () {
            return 'Por favor ingrese 1 o más caracteres';
          },
          noResults: function () {
            return 'No se encontraron resultados';
          },
          searching: function () {
            return 'Buscando...';
          },
          errorLoading: function () {
            return 'Error al cargar los resultados';
          }
        },
        dropdownParent: $(this.modalId),
        dropdownAutoWidth: true,
                    width: '100%'
      });
  
      // Aplicar clases de Bootstrap al contenedor de Select2
      $(this.selectId).data('select2').$container.addClass('form-control');
    }
  
    resetSelect2() {
      $(this.selectId).val(null).trigger('change'); // Limpiar el valor seleccionado
      $(this.selectId).empty(); // Limpiar cualquier contenido del select
      this.destroySelect2();
    }
  
    destroySelect2() {
      $(this.selectId).select2('destroy');
    }
  }
  
  // Uso de la clase
  // const modalSelect2Instance = new Select2Modal('#ModSalidas', '#miSelect', '<?=$data["url"]["select"]?>');
  










//   // Clase Select2Modal
//   class Select2Modal {
//     constructor(modalId, selectId, ajaxUrl) {
//         this.modalId = modalId;
//         this.selectId = selectId;
//         this.ajaxUrl = ajaxUrl;
//         this.initialize();
//     }

//     initialize() {
//         document.addEventListener('DOMContentLoaded', () => {
//             document.querySelector(this.modalId).addEventListener('show.bs.modal', () => {
//                 this.initSelect2();
//             });

//             document.querySelector(this.modalId).addEventListener('hidden.bs.modal', () => {
//                 this.resetSelect2();
//             });
//         });
//     }

//     initSelect2() {
//         $(this.selectId).select2({
//             theme: 'bootstrap',
//             ajax: {
//                 url: this.ajaxUrl,
//                 dataType: 'json',
//                 delay: 250,
//                 data: function (params) {
//                     return {
//                         q: params.term,
//                         page: params.page || 1
//                     };
//                 },
//                 processResults: function (data, params) {
//                     if (!data || !data.items) {
//                         console.error('Datos inválidos recibidos:', data);
//                         return {
//                             results: [],
//                             pagination: {
//                                 more: false
//                             }
//                         };
//                     }
//                     params.page = params.page || 1;
//                     return {
//                         results: data.items,
//                         pagination: {
//                             more: (params.page * 30) < data.total_count
//                         }
//                     };
//                 },
//                 cache: true
//             },
//             placeholder: 'Seleccione una opción',
//             minimumInputLength: 1,
//             language: {
//                 inputTooShort: function () {
//                     return 'Por favor ingrese 1 o más caracteres';
//                 },
//                 noResults: function () {
//                     return 'No se encontraron resultados';
//                 },
//                 searching: function () {
//                     return 'Buscando...';
//                 },
//                 errorLoading: function () {
//                     return 'Error al cargar los resultados';
//                 }
//             },
//             dropdownParent: $(this.modalId),
//             dropdownAutoWidth: true,
//             width: '100%'
//         });

//         $(this.selectId).data('select2').$container.addClass('form-control');
//     }

//     resetSelect2() {
//         $(this.selectId).val(null).trigger('change');
//         $(this.selectId).empty();
//         this.destroySelect2();
//     }

//     destroySelect2() {
//         $(this.selectId).select2('destroy');
//     }

//     initDependentSelect2(parentSelectId, childSelectId, childAjaxUrl) {
//         $(parentSelectId).select2({
//             theme: 'bootstrap',
//             placeholder: 'Seleccione una opción'
//         });

//         const updateChildSelect = () => {
//             const parentId = $(parentSelectId).val();
//             $(childSelectId).select2({
//                 theme: 'bootstrap',
//                 ajax: {
//                     url: childAjaxUrl,
//                     dataType: 'json',
//                     delay: 250,
//                     data: function (params) {
//                         return {
//                             q: params.term,
//                             parentId: parentId,
//                             page: params.page || 1
//                         };
//                     },
//                     processResults: function (data, params) {
//                         if (!data || !data.items) {
//                             console.error('Datos inválidos recibidos:', data);
//                             return {
//                                 results: [],
//                                 pagination: {
//                                     more: false
//                                 }
//                             };
//                         }
//                         params.page = params.page || 1;
//                         return {
//                             results: data.items,
//                             pagination: {
//                                 more: (params.page * 30) < data.total_count
//                             }
//                         };
//                     },
//                     cache: true
//                 },
//                 placeholder: 'Seleccione una opción',
//                 minimumInputLength: 1,
//                 language: {
//                     inputTooShort: function () {
//                         return 'Por favor ingrese 1 o más caracteres';
//                     },
//                     noResults: function () {
//                         return 'No se encontraron resultados';
//                     },
//                     searching: function () {
//                         return 'Buscando...';
//                     },
//                     errorLoading: function () {
//                         return 'Error al cargar los resultados';
//                     }
//                 },
//                 dropdownParent: $(this.modalId),
//                 dropdownAutoWidth: true,
//                 width: '100%'
//             });

//             $(childSelectId).data('select2').$container.addClass('form-control');
//         };

//         $(parentSelectId).on('change', () => {
//             $(childSelectId).val(null).trigger('change');
//             updateChildSelect();
//         });

//         updateChildSelect();
//     }
// }