import './bootstrap';

require( 'jszip' );

let pdfMake = require( 'pdfmake/build/pdfmake' );
let pdfFonts = require( 'pdfmake/build/vfs_fonts' );

pdfMake.vfs = pdfFonts.pdfMake.vfs;

require( 'datatables.net-bs5' );
require( 'datatables.net-buttons-bs5' );
require( 'datatables.net-buttons/js/buttons.colVis.js' );
require( 'datatables.net-buttons/js/buttons.html5.js' );
require( 'datatables.net-buttons/js/buttons.print.js' );
require( 'datatables.net-responsive-bs5' );
