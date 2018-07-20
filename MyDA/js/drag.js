// Drag Object
// an object that makes an unlimited number DynLayers draggable
// 19990326

// Copyright (C) 1999 Dan Steinman
// Distributed under the terms of the GNU Library General Public License
// Available at http://www.dansteinman.com/dynduo/

function Drag(dynlayer) {
	this.element = dynlayer
	this.obj = null
	this.array = new Array()
	this.active = false
	this.offsetX = 0
	this.offsetY = 0
	this.zIndex = 0
	this.resort = true
	this.add = DragAdd
	this.remove = DragRemove
	this.setGrab = DragSetGrab
	this.mouseDown = DragMouseDown
	this.mouseMove = DragMouseMove
	this.mouseUp = DragMouseUp
}
function DragAdd() {
	for (var i=0; i<arguments.length; i++) {
		var l = this.array.length
		this.array[l] = arguments[i]
		this.array[l].dragGrab = new Array(0,this.array[l].w,this.array[l].h,0)
		this.zIndex += 1
	}
}
function DragSetGrab(dynlayer,top,right,bottom,left) { 
	dynlayer.dragGrab = new Array(top,right,bottom,left)
}
function DragRemove() {
	for (var i=0; i<arguments.length; i++) {
		for (var j=0; j<this.array.length; j++) {
			if (this.array[j]==arguments[i]) {
				for (var k=j;k<=this.array.length-2;k++) this.array[k] = this.array[k+1]
				this.array[this.array.length-1] = null
				this.array.length -= 1
				break
			}
		}
	}
}
function DragMouseDown(x,y) {
	for (var i=this.array.length-1;i>=0;i--) {
		var lyr = this.array[i]
		if (this.element) {x+=this.element.x; y+=this.element.y}
		if (checkWithin(x,y,lyr.x+lyr.dragGrab[3],lyr.x+lyr.dragGrab[1],lyr.y+lyr.dragGrab[0],lyr.y+lyr.dragGrab[2])) {
			this.obj = this.array[i]
			this.offsetX = x-this.obj.x
			this.offsetY = y-this.obj.y
			this.active = true
			break
		}
	}
	if (this.active && this.resort) {
		this.obj.css.zIndex = this.zIndex++
		for (var j=i;j<=this.array.length-2;j++) this.array[j] = this.array[j+1]
		this.array[this.array.length-1] = this.obj
	}
	if (!this.active) return false
	else return true
}
function DragMouseMove(x,y) {
	if (!this.active) return false
	else {
		if (this.element) {x+=this.element.x; y+=this.element.y}
		this.obj.moveTo(x-this.offsetX,y-this.offsetY)
		return true
	}
}
function DragMouseUp() {
	if (!this.active) return false
	else {
		this.active = false
		return true
	}
}

// automatically define the "drag" object
drag = new Drag()

// checkWithin() function is required
function checkWithin(x,y,left,right,top,bottom) {
	if (x>=left && x<right && y>=top && y<bottom) return true
	else return false
}
