const App = getApp();
const apiConfig = require('api');
const CryptoJS = require('CryptoJS');
class Request {
  apiConfig = {}
  contentType = 'application/x-www-form-urlencoded;charset=utf-8;Authorization;'
  constructor() {
    this.AK = '28xpN4ETsZE1zIlM';
    this.SK = '1LbushC88tFbh4u1jJT92diHpblmofkl';
    this.wxUtils = App.wxUtils;
    this.apiConfig = apiConfig
  }
  get(url, data = {}, header = {}) {
    header = this.mergeDefaultHeader(header);
    data = this.signByData(data);
    console.log('data:', data);
    return this.wxUtils.request.get(url, data, header);
  }
  post(url, data = {}, header = {}) {
    header = this.mergeDefaultHeader(header);
    const pathInfo = this.getPathInfo(url);
    if (pathInfo) {
      for (var i = 0; i < pathInfo.length; i++) {
        data[pathInfo[i][0]] = pathInfo[i][1]
      }
    }
    data = this.signByData(data);
    return this.wxUtils.request.post(url, data, header);
  }
  mergeDefaultHeader(header = {}) {
    if (!header.hasOwnProperty('content-type'))
      header['content-type'] = this.contentType;
    return header;
  }
  signByData(data) {
    let signParams = this.getSignParams(data);
    let signtString = this.paramsFormat(signParams);
    let hashResult = CryptoJS.HmacSHA256(signtString, this.SK).toString();
    signParams['_sign'] = hashResult;
    return signParams;
  }
  getPathInfo(url) {
    let index = url.indexOf('?')
    let pathInfo = []
    if (index > -1) {
      let info = url.substring(index + 1, url.length).split('&')
      for (var i = 0; i < info.length; i++) {
        pathInfo.push(info[i].split('='))
      }
    }

    return pathInfo
  }
  paramsFormat(signParams) {
    const params = {};
    let str = '';
    Object.keys(signParams).sort().forEach(function (key) {
      params[key] = signParams[key];
    });

    for (var key in params) {
      str += key + '=' + params[key] + '&';
    }

    str = str.substr(0, str.length - 1);

    return str;
  }
  getSignParams(params) {
    let defaultParams = {
      _key: this.AK,
      _time: Date.parse(new Date()) / 1000,
      _nonce: this.wxUtils.getRandomString(false, 32),
    };
    if (params) {
      for (let key in params) {
        if (params.hasOwnProperty(key) !== true) continue;
        defaultParams[key] = params[key];
      }
    }

    return defaultParams;
  }
}

let httpRequest = new Request();

export default httpRequest;