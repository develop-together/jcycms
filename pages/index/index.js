//index.js
//获取应用实例
const app = getApp()
import httpRequest from '../../utils/request';
// {
//   "id": "261",
//   "catid": "13",
//   "typeid": "0",
//   "title": "37周的我",
//   "style": "",
//   "thumb": "https://www.zhmzjl.com\/uploadfile\/2019\/0410\/20190410110107376.jpg",
//   "keywords": "生活",
//   "description": "如果你遇到的是头猪，那你永远别和他谈理想，因为他关心的只有饲料。 不要期待，也别依赖。",
//   "posids": "0",
//   "url": "https://www.zhmzjl.com\/show-13-261-1.html",
//   "listorder": "0",
//   "status": "99",
//   "sysadd": "1",
//   "islink": "0",
//   "username": "rose",
//   "inputtime": "1585795537",
//   "updatetime": "1585795719",
//   "cnum": "1",
//   "views": "208"
// }
Page({
  data: {
    sysToDoMsg: "",
    userInfo: {},
    hasUserInfo: false,
    canIUse: wx.canIUse('button.open-type.getUserInfo'),
    page: 1,
    articleList: []
  },
  //事件处理函数
  bindViewTap: function() {
    wx.navigateTo({
      url: '../logs/logs'
    })
  },
  onLoad: function () {
    this.getArticleLists();
    if (app.globalData.userInfo) {
      this.setData({
        userInfo: app.globalData.userInfo,
        hasUserInfo: true
      })
    } else if (this.data.canIUse){
      // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
      // 所以此处加入 callback 以防止这种情况
      app.userInfoReadyCallback = res => {
        this.setData({
          userInfo: res.userInfo,
          hasUserInfo: true
        })
      }
    } else {
      // 在没有 open-type=getUserInfo 版本的兼容处理
      wx.getUserInfo({
        success: res => {
          app.globalData.userInfo = res.userInfo
          this.setData({
            userInfo: res.userInfo,
            hasUserInfo: true
          })
        }
      })
    }
  },
  getUserInfo: function(e) {
    console.log(e)
    app.globalData.userInfo = e.detail.userInfo
    this.setData({
      userInfo: e.detail.userInfo,
      hasUserInfo: true
    })
  },
  getArticleLists(e){
    let params = {
      page: this.data.page,
      'per-page': 10,
    };
    httpRequest.get(httpRequest.apiConfig.article, params).then(res => {
      let response = res.data;
      console.log('response:', response)
      if (response.code === 1000) {
        this.articleList = response.data.list;
      }
    }).catch(error => {
      debugger;
    });
  }
})
