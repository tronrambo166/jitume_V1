import home from '../components/site/home.vue'
import services from '../components/site/services.vue'
import applyShow from '../components/site/applyShow.vue'
import looking_investor from '../components/site/looking_investor.vue'
import become_provider from '../components/site/become_provider.vue'
import listingResults from '../components/site/listingResults.vue'
import listingDetails from '../components/site/listingDetails.vue'
import serviceResults from '../components/site/serviceResults.vue'
import serviceDetails from '../components/site/serviceDetails.vue'
import invest_eqp from '../components/site/invest_eqp.vue'
import donate_eqp from '../components/site/donate_eqp.vue'
import cart from '../components/site/cart.vue'
import subscribe from '../components/site/subscribe.vue'
import project_dash from '../components/site/project_dash.vue'
import category from '../components/site/category.vue'


//ADMIN COMPONENTS
import addcat from '../components/admin/category/addcat.vue'
import mancat from '../components/admin/category/mancat.vue'
import editcat from '../components/admin/category/editcat.vue'

import addpro from '../components/admin/products/addpro.vue'
import manpro from '../components/admin/products/manpro.vue'
import editpro from '../components/admin/products/editpro.vue'


//EXPORT
export const routes=[
{ path:'/', component: home},
{ path:'/home', component: home},
{ path:'/services', component: services},
{ path:'/applyShow', component: applyShow},
{ path:'/looking_investor', component: looking_investor},
{ path:'/become_provider', component: become_provider},
{ path:'/listingResults/:results',name: 'listingResults', component: listingResults},
{ path:'/listingDetails/:id', component: listingDetails},
{ path:'/invest_eqp/:id', component: invest_eqp},
{ path:'/donate_eqp/:id', component: donate_eqp},
{ path:'/subscribe/:id', component: subscribe},
{ path:'/invest/:listing_id/:id', component: invest_eqp},
{ path:'/cart', component: cart},

{ path:'/serviceResults/:results',name: 'serviceResults', component: serviceResults},
{ path:'/serviceDetails/:id', component: serviceDetails},
{ path:'/project_dash/:id', component: project_dash},
{ path:'/category/:name', component: category},


//ADMIN ROUTES
{path:'/add-category', component: addcat},
{ path:'/manage-category', component: mancat},
{ path:'/edit-category/:id', component: editcat},

{path:'/add-product', component: addpro},
{ path:'/manage-product', component: manpro},
{ path:'/edit-product/:id', component: editpro},



];


