var App = Ember.Application.create();

App.Router.map(function() {
  this.resource("messages");
  this.resource("users");
});

App.IndexRoute = Ember.Route.extend({
    redirect: function() {
        this.transitionTo("users");
    }
});

App.MessagesRoute = Ember.Route.extend({
    model: function(args) {
        return App.Message.find();
    }
});

App.UsersRoute = Ember.Route.extend({
    model: function() {
        return App.User.find();
    }
});

// AUTO-GENERATED
// App.MessagesController = Ember.ArrayController.extend({});

App.Store = DS.Store.extend({
  revision: 11,
  adapter: DS.RESTAdapter.create({
    url: url
  })
});

App.Message = DS.Model.extend({
    user: DS.belongsTo("App.User"),
    text: DS.attr('string')
});

App.User = DS.Model.extend({
    messages: DS.hasMany("App.Message"),
    screen_name: DS.attr("string")
});
