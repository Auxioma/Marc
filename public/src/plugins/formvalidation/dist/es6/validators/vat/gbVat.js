export default function t(t){let s=t;if(/^GB[0-9]{9}$/.test(s)||/^GB[0-9]{12}$/.test(s)||/^GBGD[0-9]{3}$/.test(s)||/^GBHA[0-9]{3}$/.test(s)||/^GB(GD|HA)8888[0-9]{5}$/.test(s)){s=s.substr(2)}if(!/^[0-9]{9}$/.test(s)&&!/^[0-9]{12}$/.test(s)&&!/^GD[0-9]{3}$/.test(s)&&!/^HA[0-9]{3}$/.test(s)&&!/^(GD|HA)8888[0-9]{5}$/.test(s)){return{meta:{},valid:false}}const e=s.length;if(e===5){const t=s.substr(0,2);const e=parseInt(s.substr(2),10);return{meta:{},valid:"GD"===t&&e<500||"HA"===t&&e>=500}}else if(e===11&&("GD8888"===s.substr(0,6)||"HA8888"===s.substr(0,6))){if("GD"===s.substr(0,2)&&parseInt(s.substr(6,3),10)>=500||"HA"===s.substr(0,2)&&parseInt(s.substr(6,3),10)<500){return{meta:{},valid:false}}return{meta:{},valid:parseInt(s.substr(6,3),10)%97===parseInt(s.substr(9,2),10)}}else if(e===9||e===12){const t=[8,7,6,5,4,3,2,10,1];let e=0;for(let r=0;r<9;r++){e+=parseInt(s.charAt(r),10)*t[r]}e=e%97;const r=parseInt(s.substr(0,3),10)>=100?e===0||e===42||e===55:e===0;return{meta:{},valid:r}}return{meta:{},valid:true}}