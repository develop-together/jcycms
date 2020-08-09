/**
 * @Author: Jeffrey
 * @Date: 2019-04
 * @Github: https://github.com/YYJeffrey/wxutil
 */

/**
 * request用法：
 * 1.request.get(url).then((data) => {}).catch((error) => {})
 * 2.request.post(url, data = {}, header = {}).then((data) => {}).catch((error) => {})
 * 3.request.put(url, data = {}, header = {}).then((data) => {}).catch((error) => {})
 * 4.request.delete(url, data = {}, header = {}).then((data) => {}).catch((error) => {})
 * @param {String} url
 * @param {JSON Object} data
 * @param {JSON Object} header
 */
const request = {
  get(url, data = {}, header = {}) {
    const handler = { url, data, header }
    return this.Request('GET', handler)
  },

  post(url, data = {}, header = {}) {
    const handler = { url, data, header }
    return this.Request('POST', handler)
  },

  put(url, data = {}, header = {}) {
    const handler = { url, data, header }
    return this.Request('PUT', handler)
  },

  delete(url, data = {}, header = {}) {
    const handler = { url, data, header }
    return this.Request('DELETE', handler)
  },

  // RequestHandler
  Request(method, handler) {
    const { url, data, header } = handler
    let head = {
      'content-type': 'application/json'
    }
    if (getApp().getHeader) {
      const appHeader = getApp().getHeader()
      head = Object.assign(head, appHeader)
    }
    wx.showNavigationBarLoading()
    return new Promise((resolve, reject) => {
      wx.request({
        url: url,
        data: data,
        header: Object.assign(head, header),
        method: ['GET', 'POST', 'PUT', 'DELETE'].indexOf(method) > -1 ? method : 'GET',
        success(res) {
          if (getApp().gotoAuthPage) {
            getApp().gotoAuthPage(res)
          }
          resolve(res)
        },
        fail() {
          reject('request failed')
        },
        complete() {
          wx.hideNavigationBarLoading()
        }
      })
    })
  }
}

/**
 * file用法：
 * 1.file.download(url).then((data) => {})
 * 2.file.upload({url: url, fileKey: fileKey, filePath: filePath, data: {}, header: {}}).then((data) => {})
 * @param {JSON Object} handler
 */
const file = {
  download(handler) {
    if (typeof handler === 'string') {
      handler = {
        url: String(handler)
      }
    }
    const { url, filePath, header } = handler
    return new Promise((resolve, reject) => {
      let head = {}
      if (getApp().getHeader) {
        const appHeader = getApp().getHeader()
        head = Object.assign(head, appHeader)
      }
      wx.showNavigationBarLoading()
      wx.downloadFile({
        url: url,
        filePath: filePath,
        header: Object.assign(head, header),
        success(res) {
          resolve(res)
        },
        fail() {
          reject('downloadFile failed')
        },
        complete() {
          wx.hideNavigationBarLoading()
        }
      })
    })
  },

  upload(handler) {
    const { url, fileKey, filePath, data, header } = handler
    return new Promise((resolve, reject) => {
      let head = {}
      if (getApp().getHeader) {
        const appHeader = getApp().getHeader()
        head = Object.assign(head, appHeader)
      }
      wx.showNavigationBarLoading()
      wx.uploadFile({
        url: url,
        name: fileKey,
        filePath: filePath,
        formData: data,
        header: Object.assign(head, header),
        success(res) {
          resolve(res)
        },
        fail() {
          reject('uploadFile failed')
        },
        complete() {
          wx.hideNavigationBarLoading()
        }
      })
    })
  }
}

/**
 * socket用法：
 * let socketOpen = false
 * socket.connect(url)
 *
 * wx.onSocketMessage((res) => {
 *  console.log(res)
 * }
 *
 * wx.onSocketOpen((res) => {
 *  socketOpen = true
 *  if socketOpen: socket.send("hello").then((data) => {})
 *  socket.close(url) || wx.closeSocket()
 * })
 * @param {String} url
 * @param {JSON Object} handler
 * @param {JSON Object} data
 */
const socket = {
  connect(url, handler = {}) {
    const { header, protocols } = handler
    let head = {
      'content-type': 'application/json'
    }
    if (getApp().getHeader) {
      const appHeader = getApp().getHeader()
      head = Object.assign(head, appHeader)
    }
    return new Promise((resolve, reject) => {
      wx.connectSocket({
        url: url,
        header: Object.assign(head, header),
        protocols: typeof protocols === 'undefined' ? [] : protocols,
        success(res) {
          resolve(res)
        },
        fail() {
          reject('connect failed')
        }
      })
    })
  },

  // 需在onSocketOpen回调内使用
  send(data) {
    return new Promise((resolve, reject) => {
      wx.sendSocketMessage({
        data: data,
        success(res) {
          resolve(res)
        },
        fail() {
          reject('sendSocket failed')
        }
      })
    })
  },

  close(url) {
    wx.connectSocket({
      url: url
    })
  }
}

/**
 * image用法：
 * 1.image.save(path).then((data) => {})
 * 2.image.choose(1).then((data) => {})
 * @param {String} path
 * @param {JSON Object} urls
 */
const image = {
  save(path) {
    return new Promise((resolve, reject) => {
      wx.saveImageToPhotosAlbum({
        filePath: path,
        success(res) {
          resolve(res)
        },
        fail() {
          reject('saveImage failed')
        }
      })
    })
  },

  choose(count = 9, sourceType = ['album', 'camera']) {
    return new Promise((resolve, reject) => {
      wx.chooseImage({
        count: count,
        sourceType: sourceType,
        success(res) {
          resolve(res)
        },
        fail() {
          reject('chooseImage failed')
        }
      })
    })
  }
}

/**
 * showToast用法：
 * showToast("成功")
 * @param {String} title
 * @param {JSON Object} handler
 */
const showToast = (title, handler = {}) => {
  const { icon, image, duration, mask } = handler
  return new Promise((resolve, reject) => {
    wx.showToast({
      title: title,
      image: image,
      icon: typeof icon === 'undefined' ? 'none' : icon,
      duration: typeof duration === 'undefined' ? 1000 : duration,
      mask: typeof mask === 'undefined' ? true : mask,
      success(res) {
        resolve(res)
      },
      fail() {
        reject('showToast failed')
      }
    })
  })
}

/**
 * showModal用法：
 * showModal("提示", "这是一个模态弹窗")
 * @param {String} title
 * @param {String} content
 * @param {JSON Object} handler
 */
const showModal = (title, content, handler = {}) => {
  const {
    showCancel,
    cancelText,
    confirmText,
    cancelColor,
    confirmColor
  } = handler
  return new Promise((resolve, reject) => {
    wx.showModal({
      title: title,
      content: content,
      showCancel: typeof showCancel === 'undefined' ? true : showCancel,
      cancelText: typeof cancelText === 'undefined' ? '取消' : cancelText,
      confirmText: typeof confirmText === 'undefined' ? '确定' : confirmText,
      cancelColor: typeof cancelColor === 'undefined' ? '#000000' : cancelColor,
      confirmColor:
        typeof confirmColor === 'undefined' ? '#576B95' : confirmColor,
      success(res) {
        resolve(res)
      },
      fail() {
        reject('showModal failed')
      }
    })
  })
}

/**
 * showLoading用法：
 * showLoading("加载中")
 * @param {String} title
 * @param {Boolean} mask
 */
const showLoading = (title = "加载中...", mask = true) => {
  return new Promise((resolve, reject) => {
    wx.showLoading({
      title: title,
      mask: mask,
      success(res) {
        resolve(res)
      },
      fail() {
        reject('showLoading failed')
      }
    })
  })
}

/**
 * showActionSheet用法：
 * showActionSheet(['A', 'B', 'C']).then((data) => {})
 * @param {Array.<String>} itemList
 * @param {String} itemColor
 */
const showActionSheet = (itemList, itemColor = '#000000') => {
  return new Promise(resolve => {
    wx.showActionSheet({
      itemList: itemList,
      itemColor: itemColor,
      success(res) {
        resolve(res.tapIndex)
      },
      fail() {
        return
      }
    })
  })
}

/**
 * setStorage用法：
 * 1.setStorage("userInfo", userInfo)
 * 2.setStorage("userInfo", userInfo, 86400)
 * @param {String} key
 * @param {Object} value
 * @param {Int} time 过期时间，可选参数
 */
const setStorage = (key, value, time) => {
  const dtime = '_deadtime'
  wx.setStorageSync(key, value)
  const seconds = parseInt(time)
  if (seconds > 0) {
    let timestamp = Date.parse(new Date()) / 1000 + seconds
    wx.setStorageSync(key + dtime, timestamp + '')
  } else {
    wx.removeStorageSync(key + dtime)
  }
}

/**
 * getStorage用法：
 * getStorage("userInfo")
 * @param {String} key
 */
const getStorage = key => {
  const dtime = '_deadtime'
  const deadtime = parseInt(wx.getStorageSync(key + dtime))
  if (deadtime && Date.parse(new Date()) / 1000 > parseInt(deadtime)) {
    return null
  }
  const res = wx.getStorageSync(key)
  if (typeof (res) == "boolean") {
    return res
  }
  return res ? res : null
}

/**
 * getLocation用法：
 * getLocation().then((data) => {})
 * @param {String} type
 * @param {Boolean} watch
 */
const getLocation = (type = 'gcj02', watch = false) => {
  return new Promise((resolve, reject) => {
    wx.getLocation({
      type: type,
      success(res) {
        resolve(res)
        const latitude = res.latitude
        const longitude = res.longitude
        if (watch) {
          wx.openLocation({
            latitude,
            longitude,
            scale: 18
          })
        }
      },
      fail() {
        reject('getLocation failed')
      }
    })
  })
}

/**
 * getUserInfo用法：
 * getUserInfo(true).then((data) => {})
 * @param {Boolean} login
 * @param {String} lang
 */
const getUserInfo = (login = false, lang = 'zh_CN') => {
  let code = null
  return new Promise((resolve, reject) => {
    wx.getUserInfo({
      withCredentials: login,
      lang: lang,
      success(res) {
        if (login) {
          wx.login({
            success(data) {
              code = data.code
              res.code = code
              resolve(res)
            }
          })
        } else {
          resolve(res)
        }
      },
      fail() {
        reject('getUserInfo failed')
      }
    })
  })
}

/**
 * 微信支付 - requestPayment用法:
 * requestPayment({timeStamp: timeStamp, nonceStr: nonceStr, packageValue: packageValue, paySign: paySign}).then((data) => {})
 * @param {JSON Object} handler
 */
const requestPayment = handler => {
  const { timeStamp, nonceStr, packageValue, paySign, signType } = handler
  return new Promise((resolve, reject) => {
    wx.requestPayment({
      timeStamp: timeStamp,
      nonceStr: nonceStr,
      package: packageValue,
      paySign: paySign,
      signType: typeof signType === 'undefined' ? 'MD5' : signType,
      success(res) {
        resolve(res)
      },
      fail() {
        reject('requestPayment failed')
      }
    })
  })
}

/**
 * 小程序自动更新 - autoUpdate用法:
 * autoUpdate()
 */
const autoUpdate = () => {
  const updateManager = wx.getUpdateManager()
  updateManager.onCheckForUpdate(res => {
    if (res.hasUpdate) {
      updateManager.onUpdateReady(() => {
        showModal('更新提示', '新版本已经准备好，是否重启应用？').then(res => {
          if (res.confirm) {
            updateManager.applyUpdate()
          }
        })
      })
      updateManager.onUpdateFailed(() => {
        showModal(
          '更新提示',
          '新版本已经准备好，请删除当前小程序，重新搜索打开'
        )
      })
    }
  })
}

/**
 * 字符串判不为空 - isNotNull用法：
 * isNotNull("text")
 * @param {String} text 字符串
 * @return {Boolean} 字符串合法返回真否则返回假
 */
const isNotNull = text => {
  if (text == null) {
    return false
  }
  if (text.match(/^\s+$/)) {
    return false
  }
  if (text.match(/^\s*$/)) {
    return false
  }
  if (text.match(/^[ ]+$/)) {
    return false
  }
  if (text.match(/^[ ]*$/)) {
    return false
  }
  return true
}

/**
 * Date增加format - 用法：
 * (new Date()).Format("yyyy-M-d H:m:s.S")
 * @param {*} fmt 
 */
Date.prototype.Format = function (fmt) {
  let o = {
    "M+": this.getMonth() + 1,                 //月份   
    "d+": this.getDate(),                    //日   
    "h+": this.getHours(),                   //小时   
    "m+": this.getMinutes(),                 //分   
    "s+": this.getSeconds(),                 //秒   
    "q+": Math.floor((this.getMonth() + 3) / 3), //季度   
    "S": this.getMilliseconds()             //毫秒   
  };
  if (/(y+)/.test(fmt))
    fmt = fmt.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
  for (let k in o)
    if (new RegExp("(" + k + ")").test(fmt))
      fmt = fmt.replace(RegExp.$1, (RegExp.$1.length == 1) ? (o[k]) : (("00" + o[k]).substr(("" + o[k]).length)));
  return fmt;
}
/**
 * 获取日期时间 - getDateTime用法：
 * getDateTime()
 * @param {Date} date 'yy-MM-dd hh:mm:ss'
 */
const getDateTime = (fmt = 'yyyy-MM-dd hh:mm:ss', date = new Date()) => {
  return date.Format(fmt);
}
/**
 * 时间是否当天
 * getIsToday()
 * @param {Date} date 
 */
const getIsToday = (date = new Date()) => {
  return new Date().toDateString() === date.toDateString();
}
/**
 * 获取时间戳 - getTimestamp用法：
 * getTimestamp()
 * @param {Date} date
 */
const getTimestamp = (date = new Date()) => {
  return date.getTime()
}
/**
 * 产生任意长度随机字母数字组合
 * @param {*} randomFlag 是否任意长度 
 * @param {*} min 任意长度最小位[固定位数]
 * @param {*} max 任意长度最大位
 */
const getRandomString = (randomFlag, min = 16, max = 128) => {
  let str = "",
    range = min,
    arr = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

  // 随机产生
  if (randomFlag) {
    range = Math.round(Math.random() * (max - min)) + min;
  }
  for (let i = 0; i < range; i++) {
    let pos = Math.round(Math.random() * (arr.length - 1));
    str += arr[pos];
  }
  return str;
}

module.exports = {
  request: request,
  file: file,
  socket: socket,
  image: image,
  showToast: showToast,
  showModal: showModal,
  showLoading: showLoading,
  showActionSheet: showActionSheet,
  setStorage: setStorage,
  getStorage: getStorage,
  getLocation: getLocation,
  getUserInfo: getUserInfo,
  requestPayment: requestPayment,
  autoUpdate: autoUpdate,
  isNotNull: isNotNull,
  getDateTime: getDateTime,
  getIsToday: getIsToday,
  getTimestamp: getTimestamp,
  getRandomString: getRandomString
}
