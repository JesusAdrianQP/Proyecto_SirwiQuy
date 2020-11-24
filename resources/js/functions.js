import api from "./api"

export default {
    //Funcion que obtiene provincias
    async getProv(department, departments){
        //Se selecciona las provincias en base a los departamentos
        for(let i = 0; i < 25; i++){
            if(department == departments[i].name){
                var id_depa = departments[i].id;
                break;
            }
        }

        //Se comunica con la lógica de negocio por el listado de provincias con la misma id de departamento
        let response = await api.post(`/prov`, {id: id_depa})
        return response;
    },
    //Funcion que obtiene distritos
    async getDist(province, provinces){
        //Se selecciona el distrito en base a la provincia seleccionada
        for(let i = 0; i < provinces.length; i++){
            if(province == provinces[i].name){
                var id_prov = provinces[i].id;
                break;
            }
        }

        //Se comunica con la logica de negocio por el listado de distritos en base a la id de la provincia
        let response = await api.post(`/dist`, {id: id_prov})
        return response;
    }
}
