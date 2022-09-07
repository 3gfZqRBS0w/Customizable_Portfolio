const converter = new showdown.Converter({
	metadata: true,
	parseImgDimensions: true,
	strikethrough: true,
	tables: true,
	ghCodeBlocks: true,
	smoothLivePreview: true,
	simpleLineBreaks: true,
	emoji: true,
});

const resizeTextarea = (textArea) => {
	if (!textArea) {
		return;
	}


	window.requestAnimationFrame(() => {
		textArea.style.height = 0;
		if (textArea.scrollHeight > 0) {
			textArea.style.height = `${textArea.scrollHeight + 2}px`;
		}
	});
};

	

const updateReadonly = (InElement, OutElement) => {
	window.requestAnimationFrame(() => {
		const htmlContent = converter.makeHtml(InElement.value);
		OutElement.innerHTML = htmlContent;
	});
};

const init = (inputEl, outputEl) => {
	inputEl.addEventListener("input", () => {
		//resizeTextarea(inputEl);
		updateReadonly(inputEl, outputEl);
	});
	inputEl.setAttribute('data-initialized', true);
}
var i = 0 ;
document.addEventListener("DOMContentLoaded", () => {
	// Bad code I'm not a javascript developer :c 
	var i = 0 ;
	while (document.querySelector("[data-el='input"+(String(i))+"']") != null && document.querySelector("[data-el='output"+(String(i))+"']") != null) {
		init(document.querySelector("[data-el='input"+(String(i))+"']"), document.querySelector("[data-el='output"+(String(i))+"']"));
		resizeTextarea(document.querySelector("[data-el='input"+(String(i))+"']"));
		updateReadonly(document.querySelector("[data-el='input"+(String(i))+"']"), document.querySelector("[data-el='output"+(String(i))+"']"));
		i++;
	}
})







