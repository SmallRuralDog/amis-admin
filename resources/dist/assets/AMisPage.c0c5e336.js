var D=Object.defineProperty,V=Object.defineProperties;var j=Object.getOwnPropertyDescriptors;var P=Object.getOwnPropertySymbols;var F=Object.prototype.hasOwnProperty,R=Object.prototype.propertyIsEnumerable;var b=(a,e,s)=>e in a?D(a,e,{enumerable:!0,configurable:!0,writable:!0,value:s}):a[e]=s,w=(a,e)=>{for(var s in e||(e={}))F.call(e,s)&&b(a,s,e[s]);if(P)for(var s of P(e))R.call(e,s)&&b(a,s,e[s]);return a},S=(a,e)=>V(a,j(e));import{d as h,R as z,r as Z,c as m,f as l,h as d,j as f,k as q,l as T,n as i,u as t,C as G,D as p,q as u,B as $,Y as y,P as g,F as O,x as v,v as W,T as E,Z as Y,z as H,g as I,ae as K,_ as L,w as Q,o as U}from"./main.c648d542.js";import{g as X,Z as x,$ as M,a0 as ee,h as se,F as B,_ as te,w as oe,a1 as ae,W as re}from"./AMisRenderer.03fce410.js";const le=["light","dark"],ne=X({title:{type:String,default:""},description:{type:String,default:""},type:{type:String,values:x(M),default:"info"},closable:{type:Boolean,default:!0},closeText:{type:String,default:""},showIcon:Boolean,center:Boolean,effect:{type:String,values:le,default:"light"}}),ie={close:a=>a instanceof MouseEvent},ce=h({name:"ElAlert"}),pe=h(S(w({},ce),{props:ne,emits:ie,setup(a,{emit:e}){const s=a,{Close:c}=ee,n=z(),o=se("alert"),k=Z(!0),_=m(()=>M[s.type]),A=m(()=>[o.e("icon"),{[o.is("big")]:!!s.description||!!n.default}]),N=m(()=>({[o.is("bold")]:s.description||n.default})),C=r=>{k.value=!1,e("close",r)};return(r,me)=>(l(),d(E,{name:t(o).b("fade"),persisted:""},{default:f(()=>[q(T("div",{class:i([t(o).b(),t(o).m(r.type),t(o).is("center",r.center),t(o).is(r.effect)]),role:"alert"},[r.showIcon&&t(_)?(l(),d(t(B),{key:0,class:i(t(A))},{default:f(()=>[(l(),d(G(t(_))))]),_:1},8,["class"])):p("v-if",!0),T("div",{class:i(t(o).e("content"))},[r.title||r.$slots.title?(l(),u("span",{key:0,class:i([t(o).e("title"),t(N)])},[$(r.$slots,"title",{},()=>[y(g(r.title),1)])],2)):p("v-if",!0),r.$slots.default||r.description?(l(),u("p",{key:1,class:i(t(o).e("description"))},[$(r.$slots,"default",{},()=>[y(g(r.description),1)])],2)):p("v-if",!0),r.closable?(l(),u(O,{key:2},[r.closeText?(l(),u("div",{key:0,class:i([t(o).e("close-btn"),t(o).is("customed")]),onClick:C},g(r.closeText),3)):(l(),d(t(B),{key:1,class:i(t(o).e("close-btn")),onClick:C},{default:f(()=>[v(t(c))]),_:1},8,["class"]))],64)):p("v-if",!0)],2)],2),[[W,k.value]])]),_:3},8,["name"]))}}));var ue=te(pe,[["__file","/home/runner/work/element-plus/element-plus/packages/components/alert/src/alert.vue"]]);const de=oe(ue),J=Y("pages",()=>{let a={};const e=H({loading:!0,error:!1,errorMessage:"",pageJson:null}),s=I();return{thisPage:e,getPageJson:async n=>{try{s==null||s.appContext.config.globalProperties.$Progress.start(),e.loading=!0;const o=await ae(n);a[n]=o.data,e.pageJson=a[n],e.error=!1,e.loading=!1,s==null||s.appContext.config.globalProperties.$Progress.finish()}catch(o){console.log(o),e.error=!0,e.loading=!1,e.errorMessage=o.message,s==null||s.appContext.config.globalProperties.$Progress.fail()}}}});const fe={class:"amis-page"},ge={key:0},ke=h({__name:"AMisPage",setup(a){const{thisPage:e}=K(J()),{getPageJson:s}=J(),c=L();return Q(()=>c.path,async n=>{await s(n)}),U(async()=>{await s(c.path)}),(n,o)=>(l(),u("div",fe,[v(E,{name:"slide-up",mode:"out-in"},{default:f(()=>[!t(e).error&&t(e).pageJson?(l(),d(re,{key:t(c).path,"amis-json":t(e).pageJson},null,8,["amis-json"])):p("",!0)]),_:1}),t(e).error&&!t(e).loading?(l(),u("div",ge,[v(t(de),{closable:!1,type:"error","show-icon":""},{default:f(()=>[y(g(t(e).errorMessage),1)]),_:1})])):p("",!0)]))}});export{ke as default};