import "@justinribeiro/lite-youtube";
import axios from "axios";
import jsVectorMap from "jsvectormap";
import Swiper from "swiper/bundle";

import "jsvectormap/dist/maps/world";

window.axios = axios;
window.jsVectorMap = jsVectorMap;
window.Swiper = Swiper;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
