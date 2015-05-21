mocha.setup('bdd');
mocha.checkLeaks();
mocha.globals(['angular','jQuery*','_leaflet_resize3']);
var expect = chai.expect;
