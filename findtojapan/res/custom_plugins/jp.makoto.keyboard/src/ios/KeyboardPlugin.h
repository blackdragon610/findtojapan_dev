#import <Cordova/CDVPlugin.h>

@interface KeyboardPlugin : CDVPlugin
- (void) say:(CDVInvokedUrlCommand*)command;
- (void) allView:(CDVInvokedUrlCommand*)command;

@end
