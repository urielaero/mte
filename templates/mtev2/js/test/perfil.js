console.log("test");
describe('Perfil',function(){
    it("should be mtev2",function(){
        var name = angular.element('.title-container h1').text();
        expect(name).to.not.equal('')
    })

    it('should be send contact form',function(){
        
    })
});
