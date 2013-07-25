'use strict';

angular.module('jspratleyApp').factory('ParseService', ['$q',
function($q) {
	Parse.initialize("JKqP3t0eQhAdxtglsfSiDRmJs2XMDYOjZi0CI78v", "2p0y80eNezpAv9MXcchVrrYZygnVf9CAGuPCcopt");
	var ParseService = function() {
		return {
			get : function(model, params, successCb, errorCb) {
				var query = new Parse.Query(model), delay = $q.defer(), data = null;
				if(params) {
					//query.greaterThan(params.name, params.value);
				}
				// Retrieve the most recent ones
				query.descending("createdAt");
				query.find({
					success : function(results) {
						data = results.map(function(obj) {
							return {
								id : obj.id,
								objectId : obj.get('objectId'),
								title : obj.get('title'),
								body : obj.get('body'),
								duration : obj.get('duration'),
								day : obj.get('day'),
								meal : obj.get('meal'),
								category : obj.get('category'),
								intensity : obj.get('intensity'),
								user_id : obj.get('user_id'),
								calories : obj.get('calories'),
								date : obj.get('date').toDateString(),
								amount : obj.get('amount'),
								color : obj.get('color'),
								foodgroups : obj.get('foodgroups'),
								created : obj.createdAt,
								updated : obj.updatedAt
							}
						});
						if(successCb) {
							successCb(data);
						} else {
							delay.resolve(data);
						}
					},
					error : function(error) {
						if(errorCb) {
							errorCb(error);
						}
						delay.reject(error);
					}
				});
				return delay.promise;
			},
			destroy : function(model, data, successCb, errorCb) {
				var ParseObject = Parse.Object.extend(model);
				var _parseObject = new ParseObject(data);
				_parseObject.destroy({
					success : function(obj) {
						if(successCb) {
							successCb(obj);
						}
					},
					error : function(myObject, err) {
						if(errorCb) {
							errorCb(err);
						}
					}
				});
			},
			add : function(model, data, success, error) {
				delete data.$$hashKey;
				//console.log(data);
				//add user to this data object
				if(data.date){
					data.date = new Date(data.date);
				}
				var ParseObject = Parse.Object.extend(model);
				var _parseObject = new ParseObject(data);
				_parseObject.setACL(new Parse.ACL(Parse.User.current()));
				_parseObject.save(data, {
					success : function(object) {
						if(success) {
							success(object);
						}
					},
					error : function(err) {
						if(error) {
							error(err);
						}
					}
				});
			},
			save : function(model, data, success, error) {
				var ParseObject = Parse.Object.extend(model);
				var _parseObject = new ParseObject();
				delete data.$$hashKey;
				_parseObject.setACL(new Parse.ACL(Parse.User.current()));
				_parseObject.save(data, {
					success : function(object) {
						if(success) {
							success(object);
						}
					},
					error : function(err) {
						if(error) {
							error(err);
						}
					}
				});
			}
		}
	}
	return ParseService();
}]);
