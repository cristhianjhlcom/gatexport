import axios from "axios";
import Dropzone from "dropzone";
import jsVectorMap from "jsvectormap";
// import "jsvectormap/dist/jsvectormap.min.css";
import "jsvectormap/dist/maps/world";

window.Dropzone = Dropzone;
window.axios = axios;
window.jsVectorMap = jsVectorMap;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
