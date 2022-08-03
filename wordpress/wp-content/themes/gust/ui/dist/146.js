"use strict";(self.webpackChunkgust_builder=self.webpackChunkgust_builder||[]).push([[146],{47146:(e,t,n)=>{Object.defineProperty(t,"__esModule",{value:!0}),t.resolveMatches=m,t.generateRules=function(e,t){let n=[];for(let r of e){if(t.notClassCache.has(r))continue;if(t.classCache.has(r)){n.push(t.classCache.get(r));continue}let e=Array.from(m(r,t));0!==e.length?(t.classCache.set(r,e),n.push(e)):t.notClassCache.add(r)}return n.flat(1).map((([{sort:e,layer:n,options:o},l])=>{if(o.respectImportant)if(!0===t.tailwindConfig.important)l.walkDecls((e=>{"rule"!==e.parent.type||w(e.parent)||(e.important=!0)}));else if("string"==typeof t.tailwindConfig.important){let e=r.default.root({nodes:[l.clone()]});e.walkRules((e=>{w(e)||(e.selectors=e.selectors.map((e=>`${t.tailwindConfig.important} ${e}`)))})),l=e.nodes[0]}return[e|t.layerOrder[n],l]}))};var r=f(n(50020)),o=f(n(97161)),l=f(n(20772)),s=f(n(40293)),a=f(n(41812)),i=n(78511);function f(e){return e&&e.__esModule?e:{default:e}}let u=(0,o.default)((e=>e.first.filter((({type:e})=>"class"===e)).pop().value));function c(e){return u.transformSync(e)}function*p(e,t=1/0){if(t<0)return;let n;if(t===1/0&&e.endsWith("]")){let t=e.indexOf("[");n=["-","/"].includes(e[t-1])?t-1:-1}else n=e.lastIndexOf("-",t);if(n<0)return;let r=e.slice(0,n),o=e.slice(n+1);yield[r,o],yield*p(e,n-1)}function d(e,t){if(0===e.length||""===t.tailwindConfig.prefix)return e;for(let n of e){let[e]=n;if(e.options.respectPrefix){let e=r.default.root({nodes:[n[1].clone()]});e.walkRules((e=>{e.selector=(0,a.default)(t.tailwindConfig.prefix,e.selector)})),n[1]=e.nodes[0]}}return e}function h(e){if(0===e.length)return e;let t=[];for(let[n,o]of e){let e=r.default.root({nodes:[o.clone()]});e.walkRules((e=>{e.selector=(0,i.updateAllClasses)(e.selector,(e=>`!${e}`)),e.walkDecls((e=>e.important=!0))})),t.push([{...n,important:!0},e.nodes[0]])}return t}function g(e,t,n){if(0===t.length)return t;if(n.variantMap.has(e)){let o=n.variantMap.get(e),l=[];for(let[e,s]of t){if(!1===e.options.respectVariants){l.push([e,s]);continue}let t=r.default.root({nodes:[s.clone()]});for(let[r,s]of o){let o=t.clone();function a(e){return o.each((t=>{"rule"===t.type&&(t.selectors=t.selectors.map((t=>e({get className(){return c(t)},selector:t}))))})),o}if(null===s({container:o,separator:n.tailwindConfig.separator,modifySelectors:a}))continue;let i=[{...e,sort:r|e.sort},o.nodes[0]];l.push(i)}}return l}return[]}function y(e,t,n={}){return(0,s.default)(e)||Array.isArray(e)?Array.isArray(e)?y(e[0],t,e[1]):(t.has(e)||t.set(e,(0,l.default)(e)),[t.get(e),n]):[[e],n]}function*C(e,t){t.candidateRuleMap.has(e)&&(yield[t.candidateRuleMap.get(e),"DEFAULT"]);let n=e,r=!1;const o=t.tailwindConfig.prefix||"",l=o.length;"-"===n[l]&&(r=!0,n=o+n.slice(l+1));for(let[e,o]of p(n))if(t.candidateRuleMap.has(e))return void(yield[t.candidateRuleMap.get(e),r?`-${o}`:o])}function*m(e,t){let n=t.tailwindConfig.separator,[r,...o]=function(e,t){return e.split(new RegExp(`\\${t}(?![^[]*\\])`,"g"))}(e,n).reverse(),l=!1;r.startsWith("!")&&(l=!0,r=r.slice(1));for(let e of C(r,t)){let n=[],[r,s]=e;for(let[e,o]of r)if("function"==typeof o)for(let r of[].concat(o(s))){let[o,l]=y(r,t.postCssNodeCache);for(let t of o)n.push([{...e,options:{...e.options,...l}},t])}else if("DEFAULT"===s){let r=o,[l,s]=y(r,t.postCssNodeCache);for(let t of l)n.push([{...e,options:{...e.options,...s}},t])}n=d(n,t),l&&(n=h(n));for(let e of o)n=g(e,n,t);for(let e of n)yield e}}function w(e){return e.parent&&"atrule"===e.parent.type&&"keyframes"===e.parent.name}}}]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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QUtGLEVBQUtFLFdBQ2RBLElBRUpDLElBS1RYLEVBQVV5RCxFQUFZekQsRUFBU1IsR0FFM0JzQixJQUNGZCxFQUFVNkQsRUFBZTdELElBRzNCLElBQUssSUFBSWtFLEtBQVdxQixFQUNsQnZGLEVBQVVpRSxFQUFhQyxFQUFTbEUsRUFBU1IsR0FHM0MsSUFBSyxJQUFJa0UsS0FBUzFELFFBQ1YwRCxHQUtaLFNBQVN2QyxFQUFZUixHQUNuQixPQUFPQSxFQUFLTSxRQUErQixXQUFyQk4sRUFBS00sT0FBT0MsTUFBMEMsY0FBckJQLEVBQUtNLE9BQU9vRiIsInNvdXJjZXMiOlsid2VicGFjazovL2d1c3QtYnVpbGRlci8uL25vZGVfbW9kdWxlcy90YWlsd2luZGNzcy9saWIvaml0L2xpYi9nZW5lcmF0ZVJ1bGVzLmpzIl0sInNvdXJjZXNDb250ZW50IjpbIlwidXNlIHN0cmljdFwiO1xuXG5PYmplY3QuZGVmaW5lUHJvcGVydHkoZXhwb3J0cywgXCJfX2VzTW9kdWxlXCIsIHtcbiAgdmFsdWU6IHRydWVcbn0pO1xuZXhwb3J0cy5yZXNvbHZlTWF0Y2hlcyA9IHJlc29sdmVNYXRjaGVzO1xuZXhwb3J0cy5nZW5lcmF0ZVJ1bGVzID0gZ2VuZXJhdGVSdWxlcztcblxudmFyIF9wb3N0Y3NzID0gX2ludGVyb3BSZXF1aXJlRGVmYXVsdChyZXF1aXJlKFwicG9zdGNzc1wiKSk7XG5cbnZhciBfcG9zdGNzc1NlbGVjdG9yUGFyc2VyID0gX2ludGVyb3BSZXF1aXJlRGVmYXVsdChyZXF1aXJlKFwicG9zdGNzcy1zZWxlY3Rvci1wYXJzZXJcIikpO1xuXG52YXIgX3BhcnNlT2JqZWN0U3R5bGVzID0gX2ludGVyb3BSZXF1aXJlRGVmYXVsdChyZXF1aXJlKFwiLi4vLi4vdXRpbC9wYXJzZU9iamVjdFN0eWxlc1wiKSk7XG5cbnZhciBfaXNQbGFpbk9iamVjdCA9IF9pbnRlcm9wUmVxdWlyZURlZmF1bHQocmVxdWlyZShcIi4uLy4uL3V0aWwvaXNQbGFpbk9iamVjdFwiKSk7XG5cbnZhciBfcHJlZml4U2VsZWN0b3IgPSBfaW50ZXJvcFJlcXVpcmVEZWZhdWx0KHJlcXVpcmUoXCIuLi8uLi91dGlsL3ByZWZpeFNlbGVjdG9yXCIpKTtcblxudmFyIF9wbHVnaW5VdGlscyA9IHJlcXVpcmUoXCIuLi8uLi91dGlsL3BsdWdpblV0aWxzXCIpO1xuXG5mdW5jdGlvbiBfaW50ZXJvcFJlcXVpcmVEZWZhdWx0KG9iaikgeyByZXR1cm4gb2JqICYmIG9iai5fX2VzTW9kdWxlID8gb2JqIDogeyBkZWZhdWx0OiBvYmogfTsgfVxuXG5sZXQgY2xhc3NOYW1lUGFyc2VyID0gKDAsIF9wb3N0Y3NzU2VsZWN0b3JQYXJzZXIuZGVmYXVsdCkoc2VsZWN0b3JzID0+IHtcbiAgcmV0dXJuIHNlbGVjdG9ycy5maXJzdC5maWx0ZXIoKHtcbiAgICB0eXBlXG4gIH0pID0+IHR5cGUgPT09ICdjbGFzcycpLnBvcCgpLnZhbHVlO1xufSk7XG5cbmZ1bmN0aW9uIGdldENsYXNzTmFtZUZyb21TZWxlY3RvcihzZWxlY3Rvcikge1xuICByZXR1cm4gY2xhc3NOYW1lUGFyc2VyLnRyYW5zZm9ybVN5bmMoc2VsZWN0b3IpO1xufSAvLyBHZW5lcmF0ZSBtYXRjaCBwZXJtdXRhdGlvbnMgZm9yIGEgY2xhc3MgY2FuZGlkYXRlLCBsaWtlOlxuLy8gWydyaW5nLW9mZnNldC1ibHVlJywgJzEwMCddXG4vLyBbJ3Jpbmctb2Zmc2V0JywgJ2JsdWUtMTAwJ11cbi8vIFsncmluZycsICdvZmZzZXQtYmx1ZS0xMDAnXVxuLy8gRXhhbXBsZSB3aXRoIGR5bmFtaWMgY2xhc3Nlczpcbi8vIFsnZ3JpZC1jb2xzJywgJ1tbbGluZW5hbWVdLDFmcixhdXRvXSddXG4vLyBbJ2dyaWQnLCAnY29scy1bW2xpbmVuYW1lXSwxZnIsYXV0b10nXVxuXG5cbmZ1bmN0aW9uKiBjYW5kaWRhdGVQZXJtdXRhdGlvbnMoY2FuZGlkYXRlLCBsYXN0SW5kZXggPSBJbmZpbml0eSkge1xuICBpZiAobGFzdEluZGV4IDwgMCkge1xuICAgIHJldHVybjtcbiAgfVxuXG4gIGxldCBkYXNoSWR4O1xuXG4gIGlmIChsYXN0SW5kZXggPT09IEluZmluaXR5ICYmIGNhbmRpZGF0ZS5lbmRzV2l0aCgnXScpKSB7XG4gICAgbGV0IGJyYWNrZXRJZHggPSBjYW5kaWRhdGUuaW5kZXhPZignWycpOyAvLyBJZiBjaGFyYWN0ZXIgYmVmb3JlIGBbYCBpc24ndCBhIGRhc2ggb3IgYSBzbGFzaCwgdGhpcyBpc24ndCBhIGR5bmFtaWMgY2xhc3NcbiAgICAvLyBlZy4gc3RyaW5nW11cblxuICAgIGRhc2hJZHggPSBbJy0nLCAnLyddLmluY2x1ZGVzKGNhbmRpZGF0ZVticmFja2V0SWR4IC0gMV0pID8gYnJhY2tldElkeCAtIDEgOiAtMTtcbiAgfSBlbHNlIHtcbiAgICBkYXNoSWR4ID0gY2FuZGlkYXRlLmxhc3RJbmRleE9mKCctJywgbGFzdEluZGV4KTtcbiAgfVxuXG4gIGlmIChkYXNoSWR4IDwgMCkge1xuICAgIHJldHVybjtcbiAgfVxuXG4gIGxldCBwcmVmaXggPSBjYW5kaWRhdGUuc2xpY2UoMCwgZGFzaElkeCk7XG4gIGxldCBtb2RpZmllciA9IGNhbmRpZGF0ZS5zbGljZShkYXNoSWR4ICsgMSk7XG4gIHlpZWxkIFtwcmVmaXgsIG1vZGlmaWVyXTtcbiAgeWllbGQqIGNhbmRpZGF0ZVBlcm11dGF0aW9ucyhjYW5kaWRhdGUsIGRhc2hJZHggLSAxKTtcbn1cblxuZnVuY3Rpb24gYXBwbHlQcmVmaXgobWF0Y2hlcywgY29udGV4dCkge1xuICBpZiAobWF0Y2hlcy5sZW5ndGggPT09IDAgfHwgY29udGV4dC50YWlsd2luZENvbmZpZy5wcmVmaXggPT09ICcnKSB7XG4gICAgcmV0dXJuIG1hdGNoZXM7XG4gIH1cblxuICBmb3IgKGxldCBtYXRjaCBvZiBtYXRjaGVzKSB7XG4gICAgbGV0IFttZXRhXSA9IG1hdGNoO1xuXG4gICAgaWYgKG1ldGEub3B0aW9ucy5yZXNwZWN0UHJlZml4KSB7XG4gICAgICBsZXQgY29udGFpbmVyID0gX3Bvc3Rjc3MuZGVmYXVsdC5yb290KHtcbiAgICAgICAgbm9kZXM6IFttYXRjaFsxXS5jbG9uZSgpXVxuICAgICAgfSk7XG5cbiAgICAgIGNvbnRhaW5lci53YWxrUnVsZXMociA9PiB7XG4gICAgICAgIHIuc2VsZWN0b3IgPSAoMCwgX3ByZWZpeFNlbGVjdG9yLmRlZmF1bHQpKGNvbnRleHQudGFpbHdpbmRDb25maWcucHJlZml4LCByLnNlbGVjdG9yKTtcbiAgICAgIH0pO1xuICAgICAgbWF0Y2hbMV0gPSBjb250YWluZXIubm9kZXNbMF07XG4gICAgfVxuICB9XG5cbiAgcmV0dXJuIG1hdGNoZXM7XG59XG5cbmZ1bmN0aW9uIGFwcGx5SW1wb3J0YW50KG1hdGNoZXMpIHtcbiAgaWYgKG1hdGNoZXMubGVuZ3RoID09PSAwKSB7XG4gICAgcmV0dXJuIG1hdGNoZXM7XG4gIH1cblxuICBsZXQgcmVzdWx0ID0gW107XG5cbiAgZm9yIChsZXQgW21ldGEsIHJ1bGVdIG9mIG1hdGNoZXMpIHtcbiAgICBsZXQgY29udGFpbmVyID0gX3Bvc3Rjc3MuZGVmYXVsdC5yb290KHtcbiAgICAgIG5vZGVzOiBbcnVsZS5jbG9uZSgpXVxuICAgIH0pO1xuXG4gICAgY29udGFpbmVyLndhbGtSdWxlcyhyID0+IHtcbiAgICAgIHIuc2VsZWN0b3IgPSAoMCwgX3BsdWdpblV0aWxzLnVwZGF0ZUFsbENsYXNzZXMpKHIuc2VsZWN0b3IsIGNsYXNzTmFtZSA9PiB7XG4gICAgICAgIHJldHVybiBgISR7Y2xhc3NOYW1lfWA7XG4gICAgICB9KTtcbiAgICAgIHIud2Fsa0RlY2xzKGQgPT4gZC5pbXBvcnRhbnQgPSB0cnVlKTtcbiAgICB9KTtcbiAgICByZXN1bHQucHVzaChbeyAuLi5tZXRhLFxuICAgICAgaW1wb3J0YW50OiB0cnVlXG4gICAgfSwgY29udGFpbmVyLm5vZGVzWzBdXSk7XG4gIH1cblxuICByZXR1cm4gcmVzdWx0O1xufSAvLyBUYWtlcyBhIGxpc3Qgb2YgcnVsZSB0dXBsZXMgYW5kIGFwcGxpZXMgYSB2YXJpYW50IGxpa2UgYGhvdmVyYCwgc21gLFxuLy8gd2hhdGV2ZXIgdG8gaXQuIFdlIHVzZWQgdG8gZG8gc29tZSBleHRyYSBjYWNoaW5nIGhlcmUgdG8gYXZvaWQgZ2VuZXJhdGluZ1xuLy8gYSB2YXJpYW50IG9mIHRoZSBzYW1lIHJ1bGUgbW9yZSB0aGFuIG9uY2UsIGJ1dCB0aGlzIHdhcyBuZXZlciBoaXQgYmVjYXVzZVxuLy8gd2UgY2FjaGUgYXQgdGhlIGVudGlyZSBzZWxlY3RvciBsZXZlbCBmdXJ0aGVyIHVwIHRoZSB0cmVlLlxuLy9cbi8vIFRlY2huaWNhbGx5IHlvdSBjYW4gZ2V0IGEgY2FjaGUgaGl0IGlmIHlvdSBoYXZlIGBob3Zlcjpmb2N1czp0ZXh0LWNlbnRlcmBcbi8vIGFuZCBgZm9jdXM6aG92ZXI6dGV4dC1jZW50ZXJgIGluIHRoZSBzYW1lIHByb2plY3QsIGJ1dCBpdCBkb2Vzbid0IGZlZWxcbi8vIHdvcnRoIHRoZSBjb21wbGV4aXR5IGZvciB0aGF0IGNhc2UuXG5cblxuZnVuY3Rpb24gYXBwbHlWYXJpYW50KHZhcmlhbnQsIG1hdGNoZXMsIGNvbnRleHQpIHtcbiAgaWYgKG1hdGNoZXMubGVuZ3RoID09PSAwKSB7XG4gICAgcmV0dXJuIG1hdGNoZXM7XG4gIH1cblxuICBpZiAoY29udGV4dC52YXJpYW50TWFwLmhhcyh2YXJpYW50KSkge1xuICAgIGxldCB2YXJpYW50RnVuY3Rpb25UdXBsZXMgPSBjb250ZXh0LnZhcmlhbnRNYXAuZ2V0KHZhcmlhbnQpO1xuICAgIGxldCByZXN1bHQgPSBbXTtcblxuICAgIGZvciAobGV0IFttZXRhLCBydWxlXSBvZiBtYXRjaGVzKSB7XG4gICAgICBpZiAobWV0YS5vcHRpb25zLnJlc3BlY3RWYXJpYW50cyA9PT0gZmFsc2UpIHtcbiAgICAgICAgcmVzdWx0LnB1c2goW21ldGEsIHJ1bGVdKTtcbiAgICAgICAgY29udGludWU7XG4gICAgICB9XG5cbiAgICAgIGxldCBjb250YWluZXIgPSBfcG9zdGNzcy5kZWZhdWx0LnJvb3Qoe1xuICAgICAgICBub2RlczogW3J1bGUuY2xvbmUoKV1cbiAgICAgIH0pO1xuXG4gICAgICBmb3IgKGxldCBbdmFyaWFudFNvcnQsIHZhcmlhbnRGdW5jdGlvbl0gb2YgdmFyaWFudEZ1bmN0aW9uVHVwbGVzKSB7XG4gICAgICAgIGxldCBjbG9uZSA9IGNvbnRhaW5lci5jbG9uZSgpO1xuXG4gICAgICAgIGZ1bmN0aW9uIG1vZGlmeVNlbGVjdG9ycyhtb2RpZmllckZ1bmN0aW9uKSB7XG4gICAgICAgICAgY2xvbmUuZWFjaChydWxlID0+IHtcbiAgICAgICAgICAgIGlmIChydWxlLnR5cGUgIT09ICdydWxlJykge1xuICAgICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgICB9XG5cbiAgICAgICAgICAgIHJ1bGUuc2VsZWN0b3JzID0gcnVsZS5zZWxlY3RvcnMubWFwKHNlbGVjdG9yID0+IHtcbiAgICAgICAgICAgICAgcmV0dXJuIG1vZGlmaWVyRnVuY3Rpb24oe1xuICAgICAgICAgICAgICAgIGdldCBjbGFzc05hbWUoKSB7XG4gICAgICAgICAgICAgICAgICByZXR1cm4gZ2V0Q2xhc3NOYW1lRnJvbVNlbGVjdG9yKHNlbGVjdG9yKTtcbiAgICAgICAgICAgICAgICB9LFxuXG4gICAgICAgICAgICAgICAgc2VsZWN0b3JcbiAgICAgICAgICAgICAgfSk7XG4gICAgICAgICAgICB9KTtcbiAgICAgICAgICB9KTtcbiAgICAgICAgICByZXR1cm4gY2xvbmU7XG4gICAgICAgIH1cblxuICAgICAgICBsZXQgcnVsZVdpdGhWYXJpYW50ID0gdmFyaWFudEZ1bmN0aW9uKHtcbiAgICAgICAgICBjb250YWluZXI6IGNsb25lLFxuICAgICAgICAgIHNlcGFyYXRvcjogY29udGV4dC50YWlsd2luZENvbmZpZy5zZXBhcmF0b3IsXG4gICAgICAgICAgbW9kaWZ5U2VsZWN0b3JzXG4gICAgICAgIH0pO1xuXG4gICAgICAgIGlmIChydWxlV2l0aFZhcmlhbnQgPT09IG51bGwpIHtcbiAgICAgICAgICBjb250aW51ZTtcbiAgICAgICAgfVxuXG4gICAgICAgIGxldCB3aXRoT2Zmc2V0ID0gW3sgLi4ubWV0YSxcbiAgICAgICAgICBzb3J0OiB2YXJpYW50U29ydCB8IG1ldGEuc29ydFxuICAgICAgICB9LCBjbG9uZS5ub2Rlc1swXV07XG4gICAgICAgIHJlc3VsdC5wdXNoKHdpdGhPZmZzZXQpO1xuICAgICAgfVxuICAgIH1cblxuICAgIHJldHVybiByZXN1bHQ7XG4gIH1cblxuICByZXR1cm4gW107XG59XG5cbmZ1bmN0aW9uIHBhcnNlUnVsZXMocnVsZSwgY2FjaGUsIG9wdGlvbnMgPSB7fSkge1xuICAvLyBQb3N0Q1NTIG5vZGVcbiAgaWYgKCEoMCwgX2lzUGxhaW5PYmplY3QuZGVmYXVsdCkocnVsZSkgJiYgIUFycmF5LmlzQXJyYXkocnVsZSkpIHtcbiAgICByZXR1cm4gW1tydWxlXSwgb3B0aW9uc107XG4gIH0gLy8gVHVwbGVcblxuXG4gIGlmIChBcnJheS5pc0FycmF5KHJ1bGUpKSB7XG4gICAgcmV0dXJuIHBhcnNlUnVsZXMocnVsZVswXSwgY2FjaGUsIHJ1bGVbMV0pO1xuICB9IC8vIFNpbXBsZSBvYmplY3RcblxuXG4gIGlmICghY2FjaGUuaGFzKHJ1bGUpKSB7XG4gICAgY2FjaGUuc2V0KHJ1bGUsICgwLCBfcGFyc2VPYmplY3RTdHlsZXMuZGVmYXVsdCkocnVsZSkpO1xuICB9XG5cbiAgcmV0dXJuIFtjYWNoZS5nZXQocnVsZSksIG9wdGlvbnNdO1xufVxuXG5mdW5jdGlvbiogcmVzb2x2ZU1hdGNoZWRQbHVnaW5zKGNsYXNzQ2FuZGlkYXRlLCBjb250ZXh0KSB7XG4gIGlmIChjb250ZXh0LmNhbmRpZGF0ZVJ1bGVNYXAuaGFzKGNsYXNzQ2FuZGlkYXRlKSkge1xuICAgIHlpZWxkIFtjb250ZXh0LmNhbmRpZGF0ZVJ1bGVNYXAuZ2V0KGNsYXNzQ2FuZGlkYXRlKSwgJ0RFRkFVTFQnXTtcbiAgfVxuXG4gIGxldCBjYW5kaWRhdGVQcmVmaXggPSBjbGFzc0NhbmRpZGF0ZTtcbiAgbGV0IG5lZ2F0aXZlID0gZmFsc2U7XG4gIGNvbnN0IHR3Q29uZmlnUHJlZml4ID0gY29udGV4dC50YWlsd2luZENvbmZpZy5wcmVmaXggfHwgJyc7XG4gIGNvbnN0IHR3Q29uZmlnUHJlZml4TGVuID0gdHdDb25maWdQcmVmaXgubGVuZ3RoO1xuXG4gIGlmIChjYW5kaWRhdGVQcmVmaXhbdHdDb25maWdQcmVmaXhMZW5dID09PSAnLScpIHtcbiAgICBuZWdhdGl2ZSA9IHRydWU7XG4gICAgY2FuZGlkYXRlUHJlZml4ID0gdHdDb25maWdQcmVmaXggKyBjYW5kaWRhdGVQcmVmaXguc2xpY2UodHdDb25maWdQcmVmaXhMZW4gKyAxKTtcbiAgfVxuXG4gIGZvciAobGV0IFtwcmVmaXgsIG1vZGlmaWVyXSBvZiBjYW5kaWRhdGVQZXJtdXRhdGlvbnMoY2FuZGlkYXRlUHJlZml4KSkge1xuICAgIGlmIChjb250ZXh0LmNhbmRpZGF0ZVJ1bGVNYXAuaGFzKHByZWZpeCkpIHtcbiAgICAgIHlpZWxkIFtjb250ZXh0LmNhbmRpZGF0ZVJ1bGVNYXAuZ2V0KHByZWZpeCksIG5lZ2F0aXZlID8gYC0ke21vZGlmaWVyfWAgOiBtb2RpZmllcl07XG4gICAgICByZXR1cm47XG4gICAgfVxuICB9XG59XG5cbmZ1bmN0aW9uIHNwbGl0V2l0aFNlcGFyYXRvcihpbnB1dCwgc2VwYXJhdG9yKSB7XG4gIHJldHVybiBpbnB1dC5zcGxpdChuZXcgUmVnRXhwKGBcXFxcJHtzZXBhcmF0b3J9KD8hW15bXSpcXFxcXSlgLCAnZycpKTtcbn1cblxuZnVuY3Rpb24qIHJlc29sdmVNYXRjaGVzKGNhbmRpZGF0ZSwgY29udGV4dCkge1xuICBsZXQgc2VwYXJhdG9yID0gY29udGV4dC50YWlsd2luZENvbmZpZy5zZXBhcmF0b3I7XG4gIGxldCBbY2xhc3NDYW5kaWRhdGUsIC4uLnZhcmlhbnRzXSA9IHNwbGl0V2l0aFNlcGFyYXRvcihjYW5kaWRhdGUsIHNlcGFyYXRvcikucmV2ZXJzZSgpO1xuICBsZXQgaW1wb3J0YW50ID0gZmFsc2U7XG5cbiAgaWYgKGNsYXNzQ2FuZGlkYXRlLnN0YXJ0c1dpdGgoJyEnKSkge1xuICAgIGltcG9ydGFudCA9IHRydWU7XG4gICAgY2xhc3NDYW5kaWRhdGUgPSBjbGFzc0NhbmRpZGF0ZS5zbGljZSgxKTtcbiAgfSAvLyBUT0RPOiBSZWludHJvZHVjZSB0aGlzIGluIHdheXMgdGhhdCBkb2Vzbid0IGJyZWFrIG9uIGZhbHNlIHBvc2l0aXZlc1xuICAvLyBmdW5jdGlvbiBzb3J0QWdhaW5zdCh0b1NvcnQsIGFnYWluc3QpIHtcbiAgLy8gICByZXR1cm4gdG9Tb3J0LnNsaWNlKCkuc29ydCgoYSwgeikgPT4ge1xuICAvLyAgICAgcmV0dXJuIGJpZ1NpZ24oYWdhaW5zdC5nZXQoYSlbMF0gLSBhZ2FpbnN0LmdldCh6KVswXSlcbiAgLy8gICB9KVxuICAvLyB9XG4gIC8vIGxldCBzb3J0ZWQgPSBzb3J0QWdhaW5zdCh2YXJpYW50cywgY29udGV4dC52YXJpYW50TWFwKVxuICAvLyBpZiAoc29ydGVkLnRvU3RyaW5nKCkgIT09IHZhcmlhbnRzLnRvU3RyaW5nKCkpIHtcbiAgLy8gICBsZXQgY29ycmVjdGVkID0gc29ydGVkLnJldmVyc2UoKS5jb25jYXQoY2xhc3NDYW5kaWRhdGUpLmpvaW4oJzonKVxuICAvLyAgIHRocm93IG5ldyBFcnJvcihgQ2xhc3MgJHtjYW5kaWRhdGV9IHNob3VsZCBiZSB3cml0dGVuIGFzICR7Y29ycmVjdGVkfWApXG4gIC8vIH1cblxuXG4gIGZvciAobGV0IG1hdGNoZWRQbHVnaW5zIG9mIHJlc29sdmVNYXRjaGVkUGx1Z2lucyhjbGFzc0NhbmRpZGF0ZSwgY29udGV4dCkpIHtcbiAgICBsZXQgbWF0Y2hlcyA9IFtdO1xuICAgIGxldCBbcGx1Z2lucywgbW9kaWZpZXJdID0gbWF0Y2hlZFBsdWdpbnM7XG5cbiAgICBmb3IgKGxldCBbc29ydCwgcGx1Z2luXSBvZiBwbHVnaW5zKSB7XG4gICAgICBpZiAodHlwZW9mIHBsdWdpbiA9PT0gJ2Z1bmN0aW9uJykge1xuICAgICAgICBmb3IgKGxldCBydWxlU2V0IG9mIFtdLmNvbmNhdChwbHVnaW4obW9kaWZpZXIpKSkge1xuICAgICAgICAgIGxldCBbcnVsZXMsIG9wdGlvbnNdID0gcGFyc2VSdWxlcyhydWxlU2V0LCBjb250ZXh0LnBvc3RDc3NOb2RlQ2FjaGUpO1xuXG4gICAgICAgICAgZm9yIChsZXQgcnVsZSBvZiBydWxlcykge1xuICAgICAgICAgICAgbWF0Y2hlcy5wdXNoKFt7IC4uLnNvcnQsXG4gICAgICAgICAgICAgIG9wdGlvbnM6IHsgLi4uc29ydC5vcHRpb25zLFxuICAgICAgICAgICAgICAgIC4uLm9wdGlvbnNcbiAgICAgICAgICAgICAgfVxuICAgICAgICAgICAgfSwgcnVsZV0pO1xuICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICAgfSAvLyBPbmx5IHByb2Nlc3Mgc3RhdGljIHBsdWdpbnMgb24gZXhhY3QgbWF0Y2hlc1xuICAgICAgZWxzZSBpZiAobW9kaWZpZXIgPT09ICdERUZBVUxUJykge1xuICAgICAgICBsZXQgcnVsZVNldCA9IHBsdWdpbjtcbiAgICAgICAgbGV0IFtydWxlcywgb3B0aW9uc10gPSBwYXJzZVJ1bGVzKHJ1bGVTZXQsIGNvbnRleHQucG9zdENzc05vZGVDYWNoZSk7XG5cbiAgICAgICAgZm9yIChsZXQgcnVsZSBvZiBydWxlcykge1xuICAgICAgICAgIG1hdGNoZXMucHVzaChbeyAuLi5zb3J0LFxuICAgICAgICAgICAgb3B0aW9uczogeyAuLi5zb3J0Lm9wdGlvbnMsXG4gICAgICAgICAgICAgIC4uLm9wdGlvbnNcbiAgICAgICAgICAgIH1cbiAgICAgICAgICB9LCBydWxlXSk7XG4gICAgICAgIH1cbiAgICAgIH1cbiAgICB9XG5cbiAgICBtYXRjaGVzID0gYXBwbHlQcmVmaXgobWF0Y2hlcywgY29udGV4dCk7XG5cbiAgICBpZiAoaW1wb3J0YW50KSB7XG4gICAgICBtYXRjaGVzID0gYXBwbHlJbXBvcnRhbnQobWF0Y2hlcywgY29udGV4dCk7XG4gICAgfVxuXG4gICAgZm9yIChsZXQgdmFyaWFudCBvZiB2YXJpYW50cykge1xuICAgICAgbWF0Y2hlcyA9IGFwcGx5VmFyaWFudCh2YXJpYW50LCBtYXRjaGVzLCBjb250ZXh0KTtcbiAgICB9XG5cbiAgICBmb3IgKGxldCBtYXRjaCBvZiBtYXRjaGVzKSB7XG4gICAgICB5aWVsZCBtYXRjaDtcbiAgICB9XG4gIH1cbn1cblxuZnVuY3Rpb24gaW5LZXlmcmFtZXMocnVsZSkge1xuICByZXR1cm4gcnVsZS5wYXJlbnQgJiYgcnVsZS5wYXJlbnQudHlwZSA9PT0gJ2F0cnVsZScgJiYgcnVsZS5wYXJlbnQubmFtZSA9PT0gJ2tleWZyYW1lcyc7XG59XG5cbmZ1bmN0aW9uIGdlbmVyYXRlUnVsZXMoY2FuZGlkYXRlcywgY29udGV4dCkge1xuICBsZXQgYWxsUnVsZXMgPSBbXTtcblxuICBmb3IgKGxldCBjYW5kaWRhdGUgb2YgY2FuZGlkYXRlcykge1xuICAgIGlmIChjb250ZXh0Lm5vdENsYXNzQ2FjaGUuaGFzKGNhbmRpZGF0ZSkpIHtcbiAgICAgIGNvbnRpbnVlO1xuICAgIH1cblxuICAgIGlmIChjb250ZXh0LmNsYXNzQ2FjaGUuaGFzKGNhbmRpZGF0ZSkpIHtcbiAgICAgIGFsbFJ1bGVzLnB1c2goY29udGV4dC5jbGFzc0NhY2hlLmdldChjYW5kaWRhdGUpKTtcbiAgICAgIGNvbnRpbnVlO1xuICAgIH1cblxuICAgIGxldCBtYXRjaGVzID0gQXJyYXkuZnJvbShyZXNvbHZlTWF0Y2hlcyhjYW5kaWRhdGUsIGNvbnRleHQpKTtcblxuICAgIGlmIChtYXRjaGVzLmxlbmd0aCA9PT0gMCkge1xuICAgICAgY29udGV4dC5ub3RDbGFzc0NhY2hlLmFkZChjYW5kaWRhdGUpO1xuICAgICAgY29udGludWU7XG4gICAgfVxuXG4gICAgY29udGV4dC5jbGFzc0NhY2hlLnNldChjYW5kaWRhdGUsIG1hdGNoZXMpO1xuICAgIGFsbFJ1bGVzLnB1c2gobWF0Y2hlcyk7XG4gIH1cblxuICByZXR1cm4gYWxsUnVsZXMuZmxhdCgxKS5tYXAoKFt7XG4gICAgc29ydCxcbiAgICBsYXllcixcbiAgICBvcHRpb25zXG4gIH0sIHJ1bGVdKSA9PiB7XG4gICAgaWYgKG9wdGlvbnMucmVzcGVjdEltcG9ydGFudCkge1xuICAgICAgaWYgKGNvbnRleHQudGFpbHdpbmRDb25maWcuaW1wb3J0YW50ID09PSB0cnVlKSB7XG4gICAgICAgIHJ1bGUud2Fsa0RlY2xzKGQgPT4ge1xuICAgICAgICAgIGlmIChkLnBhcmVudC50eXBlID09PSAncnVsZScgJiYgIWluS2V5ZnJhbWVzKGQucGFyZW50KSkge1xuICAgICAgICAgICAgZC5pbXBvcnRhbnQgPSB0cnVlO1xuICAgICAgICAgIH1cbiAgICAgICAgfSk7XG4gICAgICB9IGVsc2UgaWYgKHR5cGVvZiBjb250ZXh0LnRhaWx3aW5kQ29uZmlnLmltcG9ydGFudCA9PT0gJ3N0cmluZycpIHtcbiAgICAgICAgbGV0IGNvbnRhaW5lciA9IF9wb3N0Y3NzLmRlZmF1bHQucm9vdCh7XG4gICAgICAgICAgbm9kZXM6IFtydWxlLmNsb25lKCldXG4gICAgICAgIH0pO1xuXG4gICAgICAgIGNvbnRhaW5lci53YWxrUnVsZXMociA9PiB7XG4gICAgICAgICAgaWYgKGluS2V5ZnJhbWVzKHIpKSB7XG4gICAgICAgICAgICByZXR1cm47XG4gICAgICAgICAgfVxuXG4gICAgICAgICAgci5zZWxlY3RvcnMgPSByLnNlbGVjdG9ycy5tYXAoc2VsZWN0b3IgPT4ge1xuICAgICAgICAgICAgcmV0dXJuIGAke2NvbnRleHQudGFpbHdpbmRDb25maWcuaW1wb3J0YW50fSAke3NlbGVjdG9yfWA7XG4gICAgICAgICAgfSk7XG4gICAgICAgIH0pO1xuICAgICAgICBydWxlID0gY29udGFpbmVyLm5vZGVzWzBdO1xuICAgICAgfVxuICAgIH1cblxuICAgIHJldHVybiBbc29ydCB8IGNvbnRleHQubGF5ZXJPcmRlcltsYXllcl0sIHJ1bGVdO1xuICB9KTtcbn0iXSwibmFtZXMiOlsiT2JqZWN0IiwiZGVmaW5lUHJvcGVydHkiLCJleHBvcnRzIiwidmFsdWUiLCJyZXNvbHZlTWF0Y2hlcyIsImdlbmVyYXRlUnVsZXMiLCJjYW5kaWRhdGVzIiwiY29udGV4dCIsImFsbFJ1bGVzIiwiY2FuZGlkYXRlIiwibm90Q2xhc3NDYWNoZSIsImhhcyIsImNsYXNzQ2FjaGUiLCJwdXNoIiwiZ2V0IiwibWF0Y2hlcyIsIkFycmF5IiwiZnJvbSIsImxlbmd0aCIsInNldCIsImFkZCIsImZsYXQiLCJtYXAiLCJzb3J0IiwibGF5ZXIiLCJvcHRpb25zIiwicnVsZSIsInJlc3BlY3RJbXBvcnRhbnQiLCJ0YWlsd2luZENvbmZpZyIsImltcG9ydGFudCIsIndhbGtEZWNscyIsImQiLCJwYXJlbnQiLCJ0eXBlIiwiaW5LZXlmcmFtZXMiLCJjb250YWluZXIiLCJfcG9zdGNzcyIsImRlZmF1bHQiLCJyb290Iiwibm9kZXMiLCJjbG9uZSIsIndhbGtSdWxlcyIsInIiLCJzZWxlY3RvcnMiLCJzZWxlY3RvciIsImxheWVyT3JkZXIiLCJfaW50ZXJvcFJlcXVpcmVEZWZhdWx0IiwiX3Bvc3Rjc3NTZWxlY3RvclBhcnNlciIsIl9wYXJzZU9iamVjdFN0eWxlcyIsIl9pc1BsYWluT2JqZWN0IiwiX3ByZWZpeFNlbGVjdG9yIiwiX3BsdWdpblV0aWxzIiwib2JqIiwiX19lc01vZHVsZSIsImNsYXNzTmFtZVBhcnNlciIsImZpcnN0IiwiZmlsdGVyIiwicG9wIiwiZ2V0Q2xhc3NOYW1lRnJvbVNlbGVjdG9yIiwidHJhbnNmb3JtU3luYyIsImNhbmRpZGF0ZVBlcm11dGF0aW9ucyIsImxhc3RJbmRleCIsIkluZmluaXR5IiwiZGFzaElkeCIsImVuZHNXaXRoIiwiYnJhY2tldElkeCIsImluZGV4T2YiLCJpbmNsdWRlcyIsImxhc3RJbmRleE9mIiwicHJlZml4Iiwic2xpY2UiLCJtb2RpZmllciIsImFwcGx5UHJlZml4IiwibWF0Y2giLCJtZXRhIiwicmVzcGVjdFByZWZpeCIsImFwcGx5SW1wb3J0YW50IiwicmVzdWx0IiwidXBkYXRlQWxsQ2xhc3NlcyIsImNsYXNzTmFtZSIsImFwcGx5VmFyaWFudCIsInZhcmlhbnQiLCJ2YXJpYW50TWFwIiwidmFyaWFudEZ1bmN0aW9uVHVwbGVzIiwicmVzcGVjdFZhcmlhbnRzIiwidmFyaWFudFNvcnQiLCJ2YXJpYW50RnVuY3Rpb24iLCJtb2RpZnlTZWxlY3RvcnMiLCJtb2RpZmllckZ1bmN0aW9uIiwiZWFjaCIsInNlcGFyYXRvciIsIndpdGhPZmZzZXQiLCJwYXJzZVJ1bGVzIiwiY2FjaGUiLCJpc0FycmF5IiwicmVzb2x2ZU1hdGNoZWRQbHVnaW5zIiwiY2xhc3NDYW5kaWRhdGUiLCJjYW5kaWRhdGVSdWxlTWFwIiwiY2FuZGlkYXRlUHJlZml4IiwibmVnYXRpdmUiLCJ0d0NvbmZpZ1ByZWZpeCIsInR3Q29uZmlnUHJlZml4TGVuIiwidmFyaWFudHMiLCJpbnB1dCIsInNwbGl0IiwiUmVnRXhwIiwic3BsaXRXaXRoU2VwYXJhdG9yIiwicmV2ZXJzZSIsInN0YXJ0c1dpdGgiLCJtYXRjaGVkUGx1Z2lucyIsInBsdWdpbnMiLCJwbHVnaW4iLCJydWxlU2V0IiwiY29uY2F0IiwicnVsZXMiLCJwb3N0Q3NzTm9kZUNhY2hlIiwibmFtZSJdLCJzb3VyY2VSb290IjoiIn0=