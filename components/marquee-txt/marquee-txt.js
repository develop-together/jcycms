// components/marquee-txt/marquee-txt.js
Component({
  /**
   * 组件的属性列表
   */
  properties: {
    msg: {// 提示信息
      type: String,
      value: ""
    },
    interval: {// 时间间隔
      type:Number,
      value: 20
    }
  },

  /**
   * 组件的初始数据
   */
  data: {
    // msg: "",
    marqueePace: 1,//滚动速度
    marqueeDistance: 0,//初始滚动距离
    marquee_margin: 30,
    size:12
  },
  /**
   * 生命周期函数
   */
  ready: function() { 
    // console.log(this.data);
  },
  /**
   * 组件所在页面的生命周期
   */  
  pageLifetimes:{
    show: function() {
      // 页面被展示
      let length = this.data.msg.length * this.data.size;//文字长度
      if  (!length) return false;
      let windowWidth = wx.getSystemInfoSync().windowWidth;// 屏幕宽度
      this.setData({
        length: length,
        windowWidth: windowWidth
      });
      this.scrolltxt();
    },
    hide: function() {
      // 页面被隐藏
    },
    resize: function(size) {
      // 页面尺寸变化
    }
  },
  /**
   * 组件的方法列表
   */
  methods: {
    scrolltxt: function() {
      let that = this;
      let length = that.data.length;//滚动文字的宽度
      let windowWidth = that.data.windowWidth;//屏幕宽度
      if (length > windowWidth){
       let interval = setInterval(function () {
        let maxscrollwidth = length + that.data.marquee_margin;//滚动的最大宽度，文字宽度+间距，如果需要一行文字滚完后再显示第二行可以修改marquee_margin值等于windowWidth即可
        let crentleft = that.data.marqueeDistance;
        if (crentleft < maxscrollwidth) {//判断是否滚动到最大宽度
         that.setData({
          marqueeDistance: crentleft + that.data.marqueePace
         })
        }
        else {
         that.setData({
          marqueeDistance: 0 // 直接重新滚动
         });
         clearInterval(interval);
         that.scrolltxt();
        }
       }, that.data.interval);
      }
      else{
        this.setData({marquee_margin: 0});
       //that.setData({ marquee_margin:1000});//只显示一条不滚动右边间距加大，防止重复显示
      }
    }
  }
})
