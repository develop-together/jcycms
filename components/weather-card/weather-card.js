// components/weather-card/weather-card.js
const QQMapWX = require('../../utils/qqmap-wx-jssdk');
const Config = {
  key: '1734a2807d8a4ef1a4a039f48a85fdfb',
  nowWeatherApi: 'https://devapi.heweather.net/v7/weather/now'
};
const App = getApp();
Component({
  /**
   * 组件的属性列表
   */
  properties: {

  },

  /**
   * 组件的初始数据
   */
  data: {
    location_text: "成都",
    location_info: "",
    temperature: '30',
    now_weather: '晴',
    feelsLike: 20,
    today_date: App.wxUtils.getDateTime("yyyy-MM-dd hh:mm"),
    wind_direction: "东南风",
    wind_scale: 1,
    wind_speed: 2,
    humidity: 10,
    qqmapsdk: null,
    cond: 100,
  },
  ready() {
    this.qqmapsdk = new QQMapWX({
      key: 'N5JBZ-U233J-ATDFD-KT3P6-2UNUV-25BHK'
    })
    this.getCityAndWeather();
  },
  /**
   * 组件的方法列表
   */
  methods: {
    getCityAndWeather() {
      let that = this;
      App.wxUtils.getLocation().then(res => {
        this.location_info = res.longitude + ',' + res.latitude;
        this.qqmapsdk.reverseGeocoder({
          location: {
            latitude: res.latitude,
            longitude: res.longitude
          },
          success: res2 => {
            let city = res2.result.address_component.city
            that.setData({
              location_text: city,
            })
            that.getNowWeather()
          }
        })
      });
    },
    getIsToday() {
      let time = new Date().toLocaleDateString();
      const endTime = new Date(time).setHours(23, 59, 59, 999);
      console.log('endTime:', endTime);
      if (new Date().getTime() <= endTime)
        return true;
      return false;
    },
    getNowWeather(isCache = true) {
      const cacheKey = 'blog_weather_today';
      const isToday = this.getIsToday();
      if (!isCache || !isToday) {
        wx.removeStorage({
          key: cacheKey,
          success(res) {
            console.log('清除缓存的天气')
          }
        })
      }
      let cacheWeather = App.wxUtils.getStorage(cacheKey);
      if (cacheWeather) {
        this.setData(cacheWeather);
        console.log('cacheWeather:', cacheWeather);
        return true;
      }
      let url = Config.nowWeatherApi + '?key=' + Config.key + '&location=' + this.location_info;
      App.wxUtils.request.get(url).then(response => {
        if (response.statusCode === 200 && response.data) {
          let data = response.data;
          const weatherNow = data.now;
          let wData = {
            temperature: weatherNow.temp,
            feelsLike: weatherNow.feelsLike,
            now_weather: weatherNow.text,
            cond: weatherNow.icon,
            wind_direction: weatherNow.windDir,
            wind_speed: weatherNow.windSpeed,
            wind_scale: weatherNow.windScale,
            humidity: weatherNow.humidity
          };
          if (isToday)
            App.wxUtils.setStorage(cacheKey, wData, 3600);
          this.setData(wData)
        }
      }).catch((error) => {

      });
    }
  }
})
