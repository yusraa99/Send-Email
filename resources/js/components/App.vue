<!-- <template>
    <img alt="Vue logo" src="./assets/logo.png">
    <HelloWorld msg="Welcome to Your Vue.js App"/>
  </template>
  
  <script>
  
  import HelloWorld from './components/HelloWorld.vue'
  
  export default {
    name: 'App',
    components: {
      HelloWorld
    },
    mounted(){
  
      console.log('e');
     // to connect the public channel
      window.Echo.channel('public').listen('Hello',(e)=>{
         console.log('go public');
         //code for displaying the serve data
         console.log(e); // the data from the server
      })
  
     // to connect the privatechannel
      window.Echo.private('test-channel.5').listen('PrivateTest',(e)=>{
         console.log('go private');
         //code for displaying the serve data
         console.log(e); // the data from the server
      })
    }
  }
  </script>
  
  <style>
  #app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
  }
  </style> -->